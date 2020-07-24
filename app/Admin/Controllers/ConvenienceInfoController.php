<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ConvenienceInfoController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('便民信息')
            ->description('列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('便民信息')
            ->description('新增')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ConvenienceInfo);

        $grid->model()->where(['user_id' => Admin::user()->id])->orderBy('id', 'desc');
        $grid->expandFilter();
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->equal('convenience_category_id', '分类')->select(ConvenienceCategory::all()->pluck('name', 'id'));
            $filter->date('created_at', '创建时间');

            $filter->like('content', '内容(含有)');
        });
        $grid->actions(function ($actions) {
//            $actions->disableDelete();
            $actions->disableView();
            $actions->disableEdit();
            $actions->append('<a target="_blank" class="btn btn-default btn-xs" href="' . admin_url('convenience_info') . '/' . $actions->getKey() . '/edit' . '"><i class="fa fa-edit"></i>编辑&nbsp;</a>');
            $actions->append('<a target="_blank" class="btn btn-default btn-xs" href="' . admin_url('convenience_posters') . '/' . $actions->getKey() . '"><i class="fa fa-image"></i>生成图片&nbsp;</a>');
        });
        $grid->id('Id');
//        $grid->user_id('用户');
        $grid->column('content', '内容')->display(function ($content) {
            return nl2br($content);
        });
        $grid->pictures('图片')->gallery(['width' => 50]);
        $grid->copyer('复制次数')->sortable();
        $grid->sharer('分享次数')->sortable();
        $grid->created_at('创建时间');
        $grid->updated_at('最后修改时间');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ConvenienceInfo::findOrFail($id));

        $show->id('Id');
        $show->user_id('User id');
        $show->content('Content');
        $show->pictures('Pictures');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ConvenienceInfo);
        $form->hidden('user_id', '用户')->value(Admin::user()->id);
        $form->select('convenience_category_id', '分类')->options(ConvenienceCategory::all()->pluck('name', 'id'))->required();
        $form->textarea('content', '内容')->required();
        $form->dragUploader('pictures', '图片');
//        $form->multipleImage('pictures', '图片');

        $form->saving(function ($form) {
            if ($form->pictures) {
                $form->pictures = explode(',', $form->pictures);
            }
        });
        return $form;
    }
}
