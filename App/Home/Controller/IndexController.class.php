<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function index()
    {
        if ($this->isMobile()) {
            redirect('http://m.enchanteur.com.cn');
        } else {
            $this->display();
        }
    }

    public function login()
    {
        $this->display();
    }

    public function dologin()
    {
        $user_name = I('user_name');
        $password = md5(I('password'));
        $model_user = M('ws_admin_user');
        $where['user_name'] = $user_name;
        $where['password'] = $password;
        $result = $model_user->where($where)->find();
        if (isset($result)) {
            $_SESSION[user_name] = $user_name;
            $this->ajaxReturn("success");
        } else {
            $this->ajaxReturn("failure");
        }
    }

    public function commercial_network()
    {
        $this->display();
    }

    public function product_validate()
    {
        $this->display();
    }

    public function liaojie_aishi()
    {
        $this->display();
    }

    public function updatereport()
    {
        $model_report = M('ws_report');
        $model_reportdetail = M('reportdetail');
        $data = array();
        $data['code1'] = I('code1');
        $data['code2'] = I('code2');
        $data['code3'] = I('code3');
        $data["datestr"] = date("Y-m-d");
        //判定当天的报表主记录是否存在
        $data_report = $model_report->where("datestr='" . $data["datestr"] . "'")->select();
        if (count($data_report) > 0) {
            $data_report[0]["pc_arrive"]++;
            $model_report->where('id = ' . $data_report[0]['id'])->field('pc_arrive')->save($data_report[0]);
        } else {
            $data["pc_arrive"] = 1;
            $model_report->data($data)->add();
        }
        //报表明细
        $data_reportdetail = $model_reportdetail->where($data)->select();
        if (count($data_reportdetail) > 0) {
            $data_reportdetail[0]["times"]++;
            $model_reportdetail->where('id = ' . $data_reportdetail[0]['id'])->field('times')->save($data_reportdetail[0]);
        } else {
            $data["times"] = 1;
            $model_reportdetail->data($data)->add();
        }
    }

    public function enchanteur_woman()
    {
        $json = '{"problems":['
            . '{"title":"如果需要写信的话，你喜欢用哪种信纸写信给朋友",'
            . '"items":[{"val":"A","choice":"牛皮纸信纸"},{"val":"B","choice":"浪漫花纹的信纸"},'
            . '{"val":"C","choice":"纯白的信纸"},{"val":"D","choice":"雅致简单的信纸"},{"val":"E","choice":"DIY信纸"}]},'
            . '{"title":"你约暗恋中的对象去玩，你会约他去什么地方",'
            . '"items":[{"val":"A","choice":"溜冰场"},{"val":"B","choice":"郊区游玩"},'
            . '{"val":"C","choice":"保龄球场"},{"val":"D","choice":"卡拉OK"},{"val":"E","choice":"咖啡厅"}]},'
            . '{"title":"这个月有充裕的余款，你同时惦记着以下东西，但只能买一件东西，你会买什么",'
            . '"items":[{"val":"A","choice":"音乐会门票"},{"val":"B","choice":"化妆品"},'
            . '{"val":"C","choice":"新款手机"},{"val":"D","choice":"名牌手袋"},{"val":"E","choice":"喜爱的裙子"}]},'
            . '{"title":"你最常穿什么风格的服装呢",'
            . '"items":[{"val":"A","choice":"简单舒适衣服"},{"val":"B","choice":"可爱的洋装"},'
            . '{"val":"C","choice":"利落的套装"},{"val":"D","choice":"无论什么风格,以裙装为主"},{"val":"E","choice":"偏爱长裙"}]},'
            . '{"title":"逛街未经试穿买下的衣服，等回到家试穿后最可能因为那种原因后悔不已",'
            . '"items":[{"val":"A","choice":"款式看腻了"},{"val":"B","choice":"不同心情不同喜好,就是不喜欢"},'
            . '{"val":"C","choice":"有类似款了"},{"val":"D","choice":"尺寸不合适"},{"val":"E","choice":"与期望值有落差"}]},'
            . '{"title":"阳光灿烂的午后,你希望有一个怎样的下午茶",'
            . '"items":[{"val":"A","choice":"蔬菜沙拉+新鲜果汁"},{"val":"B","choice":"精致可爱的蛋糕+香甜奶茶"},'
            . '{"val":"C","choice":"三文治+绿茶"},{"val":"D","choice":"水果沙拉+茉莉花茶"},{"val":"E","choice":"巧克力派+香浓牛奶"}]},'
            . '{"title":"如果需要重新布置房间,你想要以怎样的风格布置你的家",'
            . '"items":[{"val":"A","choice":"自然主义风：摆放很多花花草草,仿佛置身于一个美丽小花园"},{"val":"B","choice":"粉红梦幻风：充满梦幻的一切：公主床、蕾丝帐……"},'
            . '{"val":"C","choice":"现代主义风：注重时尚与实用的兼顾,线条明朗,个性鲜明"},{"val":"D","choice":"地中海风:蓝白的搭配让整个房间看起来通透明亮,是你的最爱"},{"val":"E","choice":"欧式格调风：吊灯地毯或是沙发床具,透露着古典艺术的美感不易过时"}]},'
            . '{"title":"公司突然宣布放半天假,抛开所有金钱交通等限制，你会选择干吗",'
            . '"items":[{"val":"A","choice":"去自然景区呼吸新鲜空气换换心情"},{"val":"B","choice":"为男朋友或有好感的异性准备一份惊喜"},'
            . '{"val":"C","choice":"在家做做手工、听音乐"},{"val":"D","choice":"找个安静的地方阅读"},{"val":"E","choice":"与最好的闺蜜会面约见"}]},'
            . '{"title":"你最更倾向于拥有哪种车给你带来的感觉",'
            . '"items":[{"val":"A","choice":"房车，可以随遇而安"},{"val":"B","choice":"宾士轿车，享受有人牵引下车的感觉"},'
            . '{"val":"C","choice":"SUV，城市公路中的豹子"},{"val":"D","choice":"劳斯莱斯式，徐徐而行，不争不抢"},{"val":"E","choice":"敞蓬轿车， 随性而为"}]},'
            . '{"title":"如果选择一种舞蹈，你更希望自己擅长的是以下哪一舞种",'
            . '"items":[{"val":"A","choice":"用有限的身体表达无限的意识：现代舞"},{"val":"B","choice":"足尖上的灵巧：芭蕾舞"},'
            . '{"val":"C","choice":"美式街舞：JAZZ"},{"val":"D","choice":"相敬如宾的宫廷双人舞"},{"val":"E","choice":"热情如火的国标舞"}]},'
            . '{"title":"哪种气息会让你觉得最舒适",'
            . '"items":[{"val":"A","choice":"大雨冲刷后泥土的芬芳"},{"val":"B","choice":"剥开橙子四溢的香味"},'
            . '{"val":"C","choice":"衣服上的阳光味道"},{"val":"D","choice":"新家具带着的木头香"},{"val":"E","choice":"夜晚飘来阵阵夜来香的幽香"}]}'
            . ']}';
        $json_xz = '{"items":['
            . '{"name":"摩羯座","date":"12月22日-1月20日","imgurl":"xz-mj.jpg","type":"魅力","desc":"严谨刻板，稳重老城的摩羯总是给人一种呆板的感觉，但实际上心地诚实善良，爱抱打不平，充满正义感。外柔内刚的性格正是魅力香氛的最大特点，前调中甜橙、谷物的清新香气，象征着摩羯的柔和之美，往后，麝香幽然吐露特异香气，绵绵不断，就像摩羯内在的刚强个性，使人为之陶醉。"},'
            . '{"name":"水瓶座","date":"1月21日-2月18日","imgurl":"xz-sp.jpg","type":"娇媚","desc":"思想超前，崇尚自由，个性像孩子般纯真，小脑袋里总会突然冒出奇思妙想。而这种天真烂漫的个性最适合她的正是娇媚香氛，清亮柔美的色调，象征破晓的曙光与希望，代表世纪初的明亮灿烂；花果香调的调性，也展现出富有欢乐活力的香水个性，宛如清新的朝露。赋予了水瓶女生独特的神秘诱惑力。"},'
            . '{"name":"双鱼座","date":"2月19日-3月20日","imgurl":"xz-sy.jpg","type":"浪漫","desc":"爱做梦，爱幻想的双鱼，总是天马行空，出其不意。天性浪漫、天真，感情丰富。与你相处，总会被你善解人意的温柔而深深吸引。浪漫香氛不正是这种浪漫情怀的专属吗？混合着繁华鲜花的香气和甜美的果香，清甜中有点羞涩，让人置身于浪漫花田，实现着双鱼座女生对梦幻之境的追求。 "},'
            . '{"name":"白羊座","date":"3月21日-4月20日","imgurl":"xz-by.jpg","type":"冰爽","desc":"深爱自由的白羊座，永远都不喜欢受到外界的压抑。精力旺盛的白羊女，有时会让人认为是急性子。但这种活跃性格又往往让你有成为聚会排队的中心人物。这样一位活力四射，又带着爽朗笑声的女生，恰如一朵独特清冽的栀子花，淡淡的杏仁加上温和的茉莉，活力中带点女性的柔和，与灿烂的夏日相得宜。"},'
            . '{"name":"金牛座","date":"4月21日-5月21日","imgurl":"xz-jn.jpg","type":"优雅","desc":"人自然亲切，个性温柔，顺从是金牛女生最大的特点。善良的她总会在他人困难时伸出援手，对他人的关爱之心是十二星座中最丰富的。而且能做到一诺千金，言出必行，有着好好的信誉度。金牛女对爱情十分专一，并且内心充满浪漫，与你相处，往往能获得最大限度的治愈。而我们优雅香型中柔和薰衣草和岩兰草宁静的香味给人安抚的力量，不正是金牛座最大的特点吗？"},'
            . '{"name":"双子座","date":"5月22日-6月21日","imgurl":"xz-shz.jpg","type":"浓情","desc":"双子座具有两面性，是公认的，有时热情高涨，有时又兴趣乏然。聪明多才的双子女生对凡事都具有好奇心，但很快又放弃探究。多面的知识让双子座们在各种聚会中迅速与他人打成一片，很有人缘。她同样喜欢被爱的感觉，在爱情方面，也总是蜜运连连，但切记不可花心喔。与你相配的香型是浓情花香，浓郁的果香象征少女的天真和甜美，琥珀和檀香的后调将甜美升华到一种恬静的境界，宁静和甜美矛盾却又如此协调，不代表着双子的两面性吗？"},'
            . '{"name":"巨蟹座","date":"6月22日-7月22日","imgurl":"xz-jx.jpg","type":"浪漫","desc":"个性温柔多情的巨蟹座女生，对爱情有着献身精神。感情丰富，有些多愁善感的倾向。具有浪漫情怀的巨蟹女生，喜欢与恋人一起营造出只属于二人的甜蜜世界。浪漫香氛的浪漫情调镌刻出巨蟹座的气质印记。清新的花香和恬静的木香，特立而出，更令人倍感温馨。这种如初吻般的甜蜜浪漫，让巨蟹座女生时刻感受着恒久不变的爱情触动。"},'
            . '{"name":"狮子座","date":"7月23日-8月23日","imgurl":"xz-sz.jpg","type":"蜜意","desc":"狮子座女生和男生一样具有英雄主义，好奇心强。狮子座女生打多待人亲切温柔，多情善感，想象力丰富，是典型的浪漫主义者。虽然有好大喜功的性格，但只要坚持不懈，终能破除万难，达到自己理想的彼岸。蜜意香氛最能演绎出狮子座女生的独特魅力，头香蕴含橙花气息，清新自然，象征着狮子女的浪漫情怀。中调的复合香气，后调的馥郁气息，淋漓尽致地把女性真我个性释放出来。"},'
            . '{"name":"处女座","date":"8月24日-9月23日","imgurl":"xz-cn.jpg","type":"浓情","desc":"处女座的女生是永远的少女。感情细腻，纯净自然。对任何事都追求完美，有着极高的要求，非常讲原则。虽然大多处女座女生比较内向害羞，但无碍她们受到大众的喜爱。要符合处女座的高要求，唯有浓情香氛，浓郁的果香象征着处女座女生的天真与甜美，温和的后调又将甜美升华到一种恬静的境界，体现出处女座的丰富内涵又和谐一致。 "},'
            . '{"name":"天秤座","date":"9月24日-10月23日","imgurl":"xz-tp.jpg","type":"优雅","desc":"对于随时都能保持平衡的天秤座的女生来说，温柔娴雅，随和顺从，平易近人的性格是她们最大的特点，因为她们天生的优雅气质是其她女性无法比拟的独特魅力。同时，天秤座女生喜欢美好的事物，追求着真挚深刻的爱情。所以要符合天秤座的香型，唯有宁静雅致的优雅花香。它那恰到好处的搭配，如自然清风，撩人心弦，把天秤座优雅的本色演绎得淋漓尽致。"},'
            . '{"name":"天蝎座","date":"10月24日-11月22日","imgurl":"xz-tx.jpg","type":"魅力","desc":"说到天蝎座女生，总离不开她的神秘感。她们拥有优雅的气质和神秘的微笑，她们外表安静温和，但内心却渴望追求激情，探究事物的真正内在。这种独特的魅力，对于异性而言有极大的吸引力。就像麝香香味绵绵弥漫的魅力香型，持久的特异香气拨人心弦，使人为之陶醉。"},'
            . '{"name":"射手座","date":"11月23日-12月21日","imgurl":"xz-ss.jpg","type":"冰爽","desc":"射手座的女生追求自由胜于一切。她们性格开朗，思维活跃，注重文化修养，对人生、未来、爱情都抱有乐观积极的态度。充满活力的性格特点刚好与冰爽香型不谋而合，那橘子花的清爽，扑面而来，随后被糅合茉莉花和杏仁的复合气息强势占据，富有淡雅味道纯真性感的味道犹如萦绕在心中的微曲，令你难以抗拒，难以释怀！"}'
            . ']}';
        $json_sy = '{"problems":['
            . '{"title":"每朵玫瑰都有它的花语，你会选择下列哪朵玫瑰呢","items":['
            . '{"val":"A","choice":"活力的绿玫瑰"},{"val":"B","choice":"优雅的香槟玫瑰"},'
            . '{"val":"C","choice":"恬静的橙红玫瑰"},{"val":"D","choice":"梦幻的粉红玫瑰"},'
            . '{"val":"E","choice":"甜蜜的紫玫瑰"},{"val":"F","choice":"知性的黄玫瑰"},{"val":"G","choice":"希望的红玫瑰"}]},'
            . '{"title":"水果含有丰富营养，你喜欢一下哪类水果呢","items":['
            . '{"val":"A","choice":"柚子"},{"val":"B","choice":"西瓜"},'
            . '{"val":"C","choice":"橘子"},{"val":"D","choice":"樱桃"},'
            . '{"val":"E","choice":"葡萄"},{"val":"F","choice":"苹果"},{"val":"G","choice":"草莓"}]},'
            . '{"title":"空闲的时候，你更希望去哪里呢","items":['
            . '{"val":"A","choice":"郊外踏青"},{"val":"B","choice":"哪里都不去，留在家里"},'
            . '{"val":"C","choice":"KTV尽情K歌"},{"val":"D","choice":"电影院看电影"},'
            . '{"val":"E","choice":"与恋人约会"},{"val":"F","choice":"书店或图书馆进修"},{"val":"G","choice":"酒吧"}]},'
            . '{"title":"魔法师可以让你变成一种动物生活一天，你希望变成什么动物呢","items":['
            . '{"val":"A","choice":"自由自在的海豚"},{"val":"B","choice":"优雅礼貌的白鹿"},'
            . '{"val":"C","choice":"与众不同的黑马"},{"val":"D","choice":"备受呵护的小兔"},'
            . '{"val":"E","choice":"美丽娇俏的猫咪"},{"val":"F","choice":"聪明魅惑的狐狸"},{"val":"G","choice":"多姿多彩的孔雀"}]},'
            . '{"title":"如果你外出旅游，你希望以下哪样东西在你身边呢","items":['
            . '{"val":"A","choice":"一套让你活动自如的运动服"},{"val":"B","choice":"一台拍摄风景的照相机"},'
            . '{"val":"C","choice":"电量持久不怕黑暗的手电筒"},{"val":"D","choice":"一盒齐全的药盒"},'
            . '{"val":"E","choice":"装满白开水的随身壶"},{"val":"F","choice":"方便书写的圆珠笔"},{"val":"G","choice":"让你时刻保持美丽的化妆盒"}]},'
            . '{"title":"如果你拥有一套别墅，你希望它建在什么地方呢","items":['
            . '{"val":"A","choice":"一望无际的大草原上"},{"val":"B","choice":"碧波粼粼的湖边"},'
            . '{"val":"C","choice":"闹市的城中心"},{"val":"D","choice":"眺望城市的半山腰"},'
            . '{"val":"E","choice":"小鸟森林"},{"val":"F","choice":"春暖花开的海边"},{"val":"G","choice":"城郊的乡村里"}]},'
            . '{"title":"出行时，你更喜欢乘坐什么交通工具呢","items":['
            . '{"val":"A","choice":"步行"},{"val":"B","choice":"汽车"},'
            . '{"val":"C","choice":"轮船"},{"val":"D","choice":"火车"},'
            . '{"val":"E","choice":"自行车"},{"val":"F","choice":"飞机"},{"val":"G","choice":"地铁"}]},'
            . '{"title":"每个女孩子鞋柜里总有许多心爱的鞋子。以下哪类鞋是你最喜欢的呢","items":['
            . '{"val":"A","choice":"运动鞋"},{"val":"B","choice":"舞鞋"},'
            . '{"val":"C","choice":"长靴"},{"val":"D","choice":"布鞋"},'
            . '{"val":"E","choice":"拖鞋"},{"val":"F","choice":"高跟鞋"},{"val":"G","choice":"凉鞋"}]},'
            . '{"title":"下列天气现哪种是你最喜欢的呢","items":['
            . '{"val":"A","choice":"晴空万里"},{"val":"B","choice":"春雨绵绵"},'
            . '{"val":"C","choice":"滂沱大雨"},{"val":"D","choice":"朦胧雾景"},'
            . '{"val":"E","choice":"凉风习习"},{"val":"F","choice":"大雪纷纷"},{"val":"G","choice":"雨后初霁"}]},'
            . '{"title":"中国各大城市，你更喜欢在以下哪座城市生活呢","items":['
            . '{"val":"A","choice":"上海"},{"val":"B","choice":"丽江"},'
            . '{"val":"C","choice":"北京"},{"val":"D","choice":"三亚"},'
            . '{"val":"E","choice":"杭州"},{"val":"F","choice":"广州"},{"val":"G","choice":"深圳"}]},'
            . '{"title":"请挑选出你最喜欢的运动（不一定需要自己参与）","items":['
            . '{"val":"A","choice":"足球"},{"val":"B","choice":"瑜珈"},'
            . '{"val":"C","choice":"慢跑"},{"val":"D","choice":"游泳"},'
            . '{"val":"E","choice":"自行车"},{"val":"F","choice":"高尔夫球"},{"val":"G","choice":"网球"}]},'
            . '{"title":"你喜欢以下哪类电影、电视剧呢","items":['
            . '{"val":"A","choice":"动作特技类"},{"val":"B","choice":"小清新电影"},'
            . '{"val":"C","choice":"伦理剧情类"},{"val":"D","choice":"喜剧搞笑类"},'
            . '{"val":"E","choice":"温馨爱情类"},{"val":"F","choice":"悬疑推理类"},{"val":"G","choice":"科幻未来类"}]}'
            . ']}';
        $obj = json_decode($json, true);
        $this->assign('problems', $obj);
        $this->assign('xzdata', json_decode($json_xz, true));
        $this->assign('sydata', json_decode($json_sy, true));
        $curtab = I('curtab', '0');
        $this->assign('curtab', $curtab);
        $this->display();
    }

    public function aishi_product()
    {
        $model_cat = M('ws_category');
        //715是手机活动类商品
        $parentdata = $model_cat->where('parent_id =0 and cat_id!=715')->order('sort_order')->select();
        $childdata1 = $model_cat->where('parent_id =680 and is_show=1')->order('sort_order')->select();
        $childdata2 = $model_cat->where('parent_id =679 and is_show=1')->order('sort_order')->select();
        $childdata3 = $model_cat->where('parent_id =677 and is_show=1')->order('sort_order')->select();

        $this->assign('parentdata', $parentdata);
        $this->assign('childdata1', $childdata1);
        $this->assign('childdata2', $childdata2);
        $this->assign('childdata3', $childdata3);

        $cat_id = I('cat_id');
        $page = I('p', 1);
        $model_goods = M('ws_goods');
        $where[0] = 'is_delete=0 and cat_id!=715';
        if (isset($cat_id) && !empty($cat_id)) {
            $where[1] = "cat_id=" . $cat_id . " or cat_id in (select cat_id from ws_category where parent_id=" . $cat_id . ")";
        }
        $goods_data = $model_goods->where($where)->page($page, '20')->order('add_time desc')->select();
        $this->assign('goodsdata', $goods_data);
        $goods_count = $model_goods->where($where)->count();
        $Page = new \Think\Page($goods_count, 20);
        // 实例化分页类 传入总记录数和每页显示的记录数
        // $Page->setConfig('prev',  '<span aria-hidden="true">上一页</span>');//上一页
//$Page->setConfig('next',  '<span aria-hidden="true">下一页</span>');//下一页
//$Page->setConfig('first', '<span aria-hidden="true">首页</span>');//第一页
//$Page->setConfig('last',  '<span aria-hidden="true">尾页</span>');//最后一页
//$Page->setConfig('theme','');设置你想显示的按钮，%XXXX%含义参照图示
//$Page->setConfig ( 'theme', '<li><a>当前%NOW_PAGE%/%TOTAL_PAGE%</a></li>  %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%' );
        $show = $Page->show(); // 分页显示输出
        $this->assign('page', $show); // 赋值分页输出
        $this->display();
    }

    public function enchanteur_article()
    {
        $model_article = M('ws_article');
        $page = I('p', 1);
        $where[0] = 'is_open=1';
        $article_data = $model_article->where($where)->page($page, '10')->order('add_time desc')->select();
        $this->assign('article_data', $article_data);
        $article_count = $model_article->where($where)->count();
        $Page = new \Think\Page($article_count, 10);
        $show = $Page->show(); // 分页显示输出
        $this->assign('page', $show); // 赋值分页输出
        $this->display();
    }

    public function articleview()
    {
        $model_article = M('ws_article');
        $article_id = I('article_id');
        $data = $model_article->where('article_id=' . $article_id)->find();
        $this->assign('data', $data);
        $this->display();
    }

    public function updatereadtimes()
    {
        $model_article = M('ws_article');
        $article_id = I('article_id');
        $data = $model_article->where('article_id=' . $article_id)->find();
        $data['readtimes'] = $data['readtimes'] + 1;
        $model_article->data($data)->save();
    }

    /*public function spcenter()
    {
        $model_spcenter = M("spcenter");
        $model_spdetail = M("spdetail");
        //banner区
        $data = $model_spcenter->where("status=1 and ispc=1 and type='banner'")->order('sequence')->select();
        $data_detail = array();
        for ($k = 0; $k < count($data); $k++) {
            $detail = $model_spdetail->where('spcenter_id=' . $data[$k]["id"])->order('sequence')->select();
            $data_detail[$k] = $detail;
        }
        //轮播区
        $data_slide = $model_spcenter->where("status=1 and ispc=1 and type='slide'")->find();
        if (isset($data_slide)) {//如果轮播区存在
            $slide_detail = $model_spdetail->where('spcenter_id=' . $data_slide["id"])->order('sequence')->select();
            $this->assign('slidedetail', $slide_detail);
        }
        $this->assign('data', $data);
        $this->assign('data_detail', $data_detail);
        $this->assign('slidedetail', $slide_detail);
        $model_config = M('webconfig');
        $config_data = $model_config->select();
        $this->assign('config_data', $config_data[0]);
        $this->display();
    }*/

    public function spcenter()
    {
        $model_nspcenter = M("nspcenter");
        $model_spcenter = M("spcenter");
        $model_spdetail = M("spdetail");
        //banner区
        //$data = $model_spcenter->where("status=1 and ispc=1 and type='banner'")->order('sequence')->select();
        //$data_detail = array();
        //for ($k = 0; $k < count($data); $k++) {
        //    $detail = $model_spdetail->where('spcenter_id=' . $data[$k]["id"])->order('sequence')->select();
        //    $data_detail[$k] = $detail;
        // }
        $data = $model_nspcenter->where("type='pc'")->find();
        //轮播区
        $data_slide = $model_spcenter->where("status=1 and ispc=1 and type='slide'")->find();
        if (isset($data_slide)) {//如果轮播区存在
            $slide_detail = $model_spdetail->where('spcenter_id=' . $data_slide["id"])->order('sequence')->select();
            $this->assign('slidedetail', $slide_detail);
        }
        $this->assign('data', $data);
        // $this->assign('data_detail', $data_detail);
        $this->assign('slidedetail', $slide_detail);
        $model_config = M('webconfig');
        $config_data = $model_config->select();
        $this->assign('config_data', $config_data[0]);
        $this->display();
    }

    public function loadimgmap()
    {
        $model_imgmap = M('imgmap');//客户端图片映射
        $data = $model_imgmap->select();
        $this->ajaxReturn(json_encode($data));
    }

    public function zoneedit()
    {
        $this->display();
    }

    public function isMobile()
    {
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
        $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
        $regex_match.=")/i";
        return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT'])) or strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!==false;
    }
}
