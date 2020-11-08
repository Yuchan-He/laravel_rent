<?php

namespace App\Models;

class Role extends Base
{
    /* 角色和权限，多对多
    * $this 为 model Role
    * 想关联的模型为 Node
    * belongsToMany(想关联的模型,中间表的表名,自己表中的外键,关联模型的键) 
    */
    public function nodes(){

    	return $this -> belongsToMany(Node::class,'role_node','role_id','node_id');
    }
}
