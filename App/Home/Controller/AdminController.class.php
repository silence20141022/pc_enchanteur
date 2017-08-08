<?php

namespace Home\Controller;

use Think\Controller;

class AdminController extends Controller
{

    public function _initialize()
    { //|| empty($_SESSION('login'))
        if (!isset($_SESSION[user_name])) {
            redirect("/index.php?c=Index&a=login");
        }
    }

    public function logout()
    {
        $_SESSION[user_name] = null;
        $this->ajaxReturn(true);
    }

    public function loadconfig()
    {
        $model_config = M('webconfig');
        $data = $model_config->select();
        $this->ajaxReturn($data[0]);
    }

    public function configsave()
    {
        $model_config = M('webconfig');
        $formdata = $_POST["formdata"];
        $json = json_decode($formdata, true);
        $result = $model_config->save($json);
        $this->ajaxReturn($result);
    }

    public function nspcenter()
    {
        $this->display();
    }

    public function wapnspcenter()
    {
        $this->display();
    }

    public function index()
    {
        $this->display();
    }

    public function splist()
    {
        $this->display();
    }

    public function report()
    {
        $this->display();
    }

    public function spload()
    {
        $zone = M('spcenter');
        $count = $zone->count();
        $list = $zone->page(I('page', 1), '20')->order('createtime desc')->select();
        echo "{data:" . json_encode($list) . ",total:" . $count . "}";
    }

    public function article_load()
    {
        $model_article = M('ws_article');
        $where['article_id'] = I('article_id');
        $data = $model_article->where($where)->find();
        $this->ajaxReturn($data);
    }

    public function articleload()
    {
        $model_article = M('ws_article');
        $count = $model_article->count();
        $list = $model_article->page(I('page', 1), '20')->order('add_time desc')->select();
        echo "{data:" . json_encode($list) . ",total:" . $count . "}";
    }

    public function articleedit()
    {
        $this->display();
    }

    public function articlelist()
    {
        $this->display();
    }

    public function loadstatistics()
    {
        $model_statis = M('ws_vote_log');
        $data = array();
        $count = 0;
        $cur_date = date("Y-m-d");
        for ($i = 0; $i < 7; $i++) {
            $data[$i]['date'] = date("Y-m-d", strtotime("$cur_date-$i day"));
            $count = $model_statis->where("source='pc' and type='visit' and date_format(vote_time,'%Y-%m-%d')=date_format(date_sub(now(),INTERVAL " . $i . " DAY),'%Y-%m-%d') ")->count();
            $data[$i]['pc_visit'] = $count;
            $count = $model_statis->where("source='pc' and type='arrive' and date_format(vote_time,'%Y-%m-%d')=date_format(date_sub(now(),INTERVAL " . $i . " DAY),'%Y-%m-%d') ")->count();
            $data[$i]['pc_arrive'] = $count;
            $count = $model_statis->where("source='wap' and type='visit' and date_format(vote_time,'%Y-%m-%d')=date_format(date_sub(now(),INTERVAL " . $i . " DAY),'%Y-%m-%d') ")->count();
            $data[$i]['wap_visit'] = $count;
            $count = $model_statis->where("source='wap' and type='arrive' and date_format(vote_time,'%Y-%m-%d')=date_format(date_sub(now(),INTERVAL " . $i . " DAY),'%Y-%m-%d') ")->count();
            $data[$i]['wap_arrive'] = $count;
        }
        $this->ajaxReturn($data);
    }

    public function deleteimg()
    {
        unlink("./Uploads/" . I("filename"));
    }

    public function loadreport()
    {
        $model_report = M('ws_report');
        $count = $model_report->count();
        $list = $model_report->page(I('page', 1), '24')->order('datestr desc')->select();
        echo "{data:" . json_encode($list) . ",total:" . $count . "}";
    }

    public function  loadreportdetail()
    {
        $model_reportdetail = M('reportdetail');
        $list = $model_reportdetail->where("datestr='" . I('datestr') . "' and code2='" . I('code2') . "'")->order('times desc')->select();
        echo json_encode($list);
    }

    public function articlesave()
    {
        $model_article = M('ws_article');
        $formdata = $_POST["formdata"];
        $json = json_decode($formdata, true);
        if (!$json['article_id']) {
            $json["add_time"] = date("Y-m-d H:i:s");
            $json['article_id'] = $model_article->data($json)->add();
        } else {
            //注意：save方法的返回值是影响的记录数，如果返回false则表示更新出错，因此一定要用恒等来判断是否更新失败
            $json["lastupdatetime"] = date("Y-m-d H:i:s");
            $model_article->where('article_id=' . $json['article_id'])->save($json);
        }
//很容易理解，json_encode()就是将PHP数组转换成Json。相反，json_decode()就是将Json转换成PHP数组。       
        $this->ajaxReturn($json["article_id"]);
    }

    public function loadnsp()
    {
        $model_nspcenter = M('nspcenter');
        // $count = $model_article->count();
        $list = $model_nspcenter->where('type="pc"')->find();
        echo json_encode($list);
    }

    public function loadwapnsp()
    {
        $model_nspcenter = M('nspcenter');
        $list = $model_nspcenter->where('type="wap"')->find();
        echo json_encode($list);
    }

    public function nspsave()
    {
        $model_nsp = M('nspcenter');
        $layout = $_POST["layout"];
        $type = $_POST["type"];
        $formdata = $_POST["formdata"];
        $data = $model_nsp->where('type="' . $type . '"')->select();
        $result = 0;
        $json["updatetime"] = date("Y-m-d H:i:s");
        $json["layout"] = $layout;
        $json["type"] = $type;
        if (count($data) == 0) {
            $result = $model_nsp->data($json)->add();
        } else {
            //注意：save方法的返回值是影响的记录数，如果返回false则表示更新出错，因此一定要用恒等来判断是否更新失败
            $model_nsp->where('id=' . $data[0]['id'])->save($json);
            $result = $json['id'];
        }
        //更新或者添加图片区域映射表
        $model_imgmap = M('imgmap');
        $json = json_decode($formdata, true);
        $mapdata = $model_imgmap->where('part_id="' . $json["field_id"] . '"')->select();
        $map = '<map name="map_' . $json["field_id"] . '">';
        if (isset($json["z1x1"])) {
            $tmp = str_replace(']);', '', str_replace('_smq.push([', '', $json["bind1"]));
            $map .= '<area coords="' . $json["z1x1"] . ',' . $json["z1y1"] . ',' . $json["z1x2"] . ',' . $json["z1y2"] . '" href="' . $json["link1"] . '" onclick="' . $json["bind1"] . 'exehis(' . $tmp . ')" target="_blank">';
        }
        if (isset($json["z2x1"])) {
            $tmp = str_replace(']);', '', str_replace('_smq.push([', '', $json["bind2"]));
            $map .= '<area coords="' . $json["z2x1"] . ',' . $json["z2y1"] . ',' . $json["z2x2"] . ',' . $json["z2y2"] . '" href="' . $json["link2"] . '" onclick="' . $json["bind2"] . 'exehis(' . $tmp . ')" target="_blank">';
        }
        if (isset($json["z3x1"])) {
            $tmp = str_replace(']);', '', str_replace('_smq.push([', '', $json["bind3"]));
            $map .= '<area coords="' . $json["z3x1"] . ',' . $json["z3y1"] . ',' . $json["z3x2"] . ',' . $json["z3y2"] . '" href="' . $json["link3"] . '" onclick="' . $json["bind3"] . 'exehis(' . $tmp . ')" target="_blank">';
        }
        if (isset($json["z4x1"])) {
            $tmp = str_replace(']);', '', str_replace('_smq.push([', '', $json["bind4"]));
            $map .= '<area coords="' . $json["z4x1"] . ',' . $json["z4y1"] . ',' . $json["z4x2"] . ',' . $json["z4y2"] . '" href="' . $json["link4"] . '" onclick="' . $json["bind4"] . 'exehis(' . $tmp . ')" target="_blank">';
        }
        $map .= '</map>';
        $json["part_id"] = $json["field_id"];
        $json["mapdetail"] = $map;
        if (count($mapdata) == 0) {
            $result = $model_imgmap->data($json)->add();
        } else {
            $model_imgmap->where('id=' . $mapdata[0]['id'])->save($json);
        }
        $this->ajaxReturn($result);
    }

    public function loadmap()
    {
        $model_imgmap = M('imgmap');
        $part_id = $_POST["part_id"];
        $map_data = $model_imgmap->where("part_id='" . $part_id . "'")->find();
        echo json_encode($map_data);
    }

    public function save()
    {
        $zone = M('spcenter');
        $formdata = $_POST["formdata"];
        $detaildata = $_POST["detaildata"];
        $json = json_decode($formdata, true);
        $result = 0;
        if (!$json['id']) {
            $json["createtime"] = date("Y-m-d H:i:s");
            $result = $zone->data($json)->add();
        } else {
            //注意：save方法的返回值是影响的记录数，如果返回false则表示更新出错，因此一定要用恒等来判断是否更新失败
            $json["lastupdatetime"] = date("Y-m-d H:i:s");
            $zone->where('id = ' . $json['id'])->save($json);
            $result = $json['id'];
        }
        $model_detail = M('spdetail');
        $array_detail = json_decode($detaildata, true);
        $url = "";
        if ($json["ispc"] == 0) {
            $url = "http://www.enchanteur.com.cn";
        }
        //所以在移动端里面改用域名显示图片 }
        for ($i = 0; $i < count($array_detail); $i++) {
            if (!$array_detail[$i]["id"]) {
                $array_detail[$i]["createtime"] = date("Y-m-d H:i:s");
                $array_detail[$i]["spcenter_id"] = $result;
                $model_detail->data($array_detail[$i])->add();
            } else {
                $model_detail->data($array_detail[$i])->save();
            }
            if ($json['type'] == 'banner') {
                $replace = '<a onclick ="' . $array_detail[$i]["imgscript"] . '" href="' . $array_detail[$i]["linkurl"] . '" target = "_blank"> ';
                $replace .= '<img src ="' . $url . '/Uploads/' . $array_detail[$i]["imgpath"] . '" alt = "" class="img-responsive"/></a> ';
                $json["layouttemplate"] = str_replace('<span class="badge">' . ($i + 1) . '</span>', $replace, $json["layouttemplate"]);
            }
        }
        if (count($array_detail) == 0) {//有时候banner区可以不放商品图片
            $json["layouttemplate"] = "";
        }
        if ($json['type'] == 'banner') {
            $json["layouttemplate"] = str_replace(' table-bordered', '', $json["layouttemplate"]);
            $zone->where('id = ' . $result)->field('layouttemplate')->save($json);
        }
//很容易理解，json_encode()就是将PHP数组转换成Json。相反，json_decode()就是将Json转换成PHP数组。       
        $this->ajaxReturn($json["layouttemplate"]);
    }

    public function loadform()
    {
        $zone = M('spcenter');
        $where['id'] = I('id');
        $data = $zone->where($where)->find(); //
        $this->ajaxReturn($data);
    }

    public function deldetail()
    {
        $model_detail = M('spdetail');
        unlink("./Uploads/" . I("filename"));
        $mysql_res = $model_detail->where('id = ' . I("id"))->delete();
        $this->ajaxReturn($mysql_res);
    }

    public function delsp()
    {
        $model_spcenter = M('spcenter');
        $where['id'] = I('id');
        $data = $model_spcenter->where($where)->find();
        if ($data["bannerfirst"]) {
            unlink("./Uploads/" . $data["bannerfirst"]);
        }
        if ($data["bannersecond"]) {
            unlink("./Uploads/" . $data["bannersecond"]);
        }
        $model_spdetail = M("spdetail");
        $data_detail = $model_spdetail->where('spcenter_id = ' . I('id'))->select();
        for ($k = 0; $k < count($data_detail); $k++) {
            unlink("./Uploads/" . $data_detail[$k]["imgpath"]);
        }
        $model_spdetail->where('spcenter_id = ' . I("id"))->delete();
        $result = $model_spcenter->where('id = ' . I('id'))->delete();
        $this->ajaxReturn($result);
    }

    public function loaddetail()
    {
        $model_spdetail = M('spdetail');
        $where["spcenter_id"] = I('id');
        $detail_data = $model_spdetail->where($where)->order('sequence')->select();
        $this->ajaxReturn($detail_data);
    }

    public function upload()
    {
        $config = array(
            'maxSize' => 3145728,
            'rootPath' => './Uploads/',
            'savePath' => '',
            'saveName' => array('uniqid', ''),
            'exts' => array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub' => false,
            //'subName' => array('date', 'Ymd'),
        );
        $upload = new \Think\Upload($config); // 实例化上传类
        $info = $upload->upload();

        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        } else {
            //// 上传成功 获取上传文件信息
//            foreach ($info as $file) {
//                echo $file['savepath'] . $file['savename'];
//            }
        }
        $this->ajaxReturn($info);
    }

    public function delarticle()
    {
        $model_article = M('ws_article');
        $article_data = $model_article->where('article_id = ' . I('article_id'))->find();
        if ($article_data["img_url"]) {
            unlink("./Uploads/" . $article_data["img_url"]);
        }
        $result = $model_article->where('article_id = ' . I('article_id'))->delete();
        $this->ajaxReturn($result);
    }

}
