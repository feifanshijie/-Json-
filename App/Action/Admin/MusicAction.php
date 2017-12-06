<?php
/**
 * Class MusicAction
 */
namespace App\Action\Admin;

use App\Data\Admin\MusicData;
use App\Param\Admin\MusicParam;
use Framework\Support\Action;

class MusicAction extends Action
{
    //TODO:参数校验
    private $_param = null;

    //TODO:初始化模型
    public function __construct()
    {
        if($this->_param === null)
        {
            $this->_param = new MusicParam();
        }
    }

    //TODO:保存添加的歌曲
    public function musicSave()
    {
        $file = $this->_param->SaveMusic();

        list($type, $data) = explode(',', $file['data']);

        if(file_put_contents($file['name'], base64_decode($data))){

            $param = [
                'name' => $file['name'],
                'path' => $file['name']
            ];

            if(MusicData::MusicAdd($param))
            {
                $this->json(['code'    => 200, 'message' => '上传成功']);
            }
        }

        $this->json(['code' => 400, 'message' => '上传失败了']);
    }

    //TODO:歌曲列表
    public function list()
    {
        $param = $this->_param->MusicList();

//        $data['now']   = 1;
        $html['nav']   = 'musicList';
        $html['title'] = '歌曲列表';

        $data['list'] = MusicData::MusicList($param);
        $data['page'] = MusicData::MusicListPaging();

        $this->view('Admin/musicList', $data, $html);
    }

    //TODO:歌单列表
    public function classList()
    {
        $html['nav']   = 'musicClassList';
        $html['title'] = '歌单列表';

        $data['list'] = [];
        $data['page'] = [];

        $this->view('Admin/musicClassList', $data, $html);
    }

    //TODO:新建歌单页
    public function classListAdd()
    {
        $html['title'] = '新建歌单';
        $html['nav'] = 'musicClassList';
        $data = [];
        $this->view('Admin/musicClassAdd', $data, $html);
    }

    //TODO:保存新建歌单
    public function saveClassList()
    {
        
    }

    //TODO:向歌单添加歌曲
    public function classListAddMusic()
    {

    }
}