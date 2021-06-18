<?php

namespace App\Admin\Controllers;

use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TopController extends Controller
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
            ->header('置顶')
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
            ->header('置顶')
            ->description('编辑')
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
            ->header('置顶')
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
        $grid->model()->where(['user_id' => Admin::user()->id])->where('is_top', 1)->orderBy('id', 'desc');
        $grid->disableFilter();
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
        $show->convenience_category_id('Convenience category id');
        $show->copyer('Copyer');
        $show->sharer('Sharer');
        $show->is_top('Is top');

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
        $form->hidden('convenience_category_id', '分类')->default(0);
        $form->textarea('content', '内容')->required();
        $form->dragUploader('pictures', '图片');
//        $form->multipleImage('pictures', '图片');
        $form->hidden('is_top', '置顶')->default(1);

        $form->saving(function ($form) {
            if ($form->pictures) {
                $form->pictures = explode(',', $form->pictures);
            }
        });

        return $form;
    }
}
