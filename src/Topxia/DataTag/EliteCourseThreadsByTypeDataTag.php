<?php

namespace Topxia\DataTag;

use Topxia\DataTag\DataTag;
use Topxia\Common\ArrayToolkit;

class EliteCourseThreadsByTypeDataTag extends CourseBaseDataTag implements DataTag  
{
    
    /**
     * 获取加精的课程话题列表
     *
     * 可传入的参数：
     *   type 选填 话题类型
     *   count 必需 课程话题数量，取值不能超过100
     * 
     * @param  array $arguments 参数
     * @return array 课程话题
     */

    public function getData(array $arguments)
    {
        $this->checkCount($arguments);

        if (empty($arguments['type'])){
            $type = array();
        } else {
            $type = $arguments['type'];
        }

        $arguments['status'] = '1';

    	$threads = $this->getThreadService()->findEliteThreadsByType($type, $arguments['status'], 0, $arguments['count']);

        foreach ($threads as $key => $thread) {
            $course = $this->getCourseService()->getCourse($thread['courseId']);
   
            $threads[$key]['courseTitle'] = $course['title'];

        }

        return $threads;
    }


}