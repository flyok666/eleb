<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class Nav extends Model
{
    //
    public static function navBar(){
        $html = '';
        //取出所有一级菜单
        $navs = self::where('pid',0)->get();
        foreach ($navs as $nav){

            //获取一级菜单的子菜单
            //$children = self::where('pid',$nav->id)->get();
            $children_html = '';
            foreach ($nav->children as $child){
                //判断当前用户是否有该菜单对应的权限
                if(Auth::user()->can($child->pemission->name)){
                    $children_html .= '<li><a href="'.url($child->url).'">'.$child->name.'</a></li>';
                }
            }
            //如果该组菜单的二级菜单都没有被显示出来（没有权限），则一级菜单也不显示
            if($children_html){
                $html .= ' <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        '.$nav->name.'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                $html .= $children_html;
                $html .= '</ul></li>';
            }


        }

        return $html;

    }

    //获取子菜单
    public function children()
    {
        //一级菜单   二级菜单    1对多
        return $this->hasMany(self::class,'pid','id');
    }
    //导航菜单  权限   关系： 1对多（反向）
    public function permission(){
        return $this->belongsTo(Permission::class,'permission_id','id');
    }
}
