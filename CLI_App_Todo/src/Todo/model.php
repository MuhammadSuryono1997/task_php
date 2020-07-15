<?php
namespace Model\Todo;

class Model
{
    function __construct()
    {

    }

    public function get_data()
    {
        $data = file_get_contents(__DIR__."/todos.json");
        $data = json_decode($data, true);
        return $data;
    }

    public function show_data()
    {
        $data = $this->get_data()['todos'];
        $show = "Todo List\n";
        $data = array_map(function($data){
            return $data['id']." ".$data['title'].($data['complete'] ? ' (DONE)':'');}, $data);
        foreach ($data as $value) 
        {
            $show .= $value."\n";
        }

        return $show;
    }

    public function add_data($new_data)
    {
        $old_data = $this->get_data();
        $old_id = count($old_data['todos']);
        $data_baru = [];

        $data_baru['id'] = $old_id + 1;
        $data_baru['title'] = $new_data;
        $data_baru['complete'] = "";
        array_push($old_data['todos'], $data_baru);
        $this->write_data($old_data);
        return true;
    }

    public function edit_data($data)
    {
        $data_filter = explode(" ",$data);
        $data = $this->get_data();
        $filter_data = array_filter($data['todos'], function($val) use($data_filter){return $val['id']==$data_filter[0];});
        foreach ($filter_data as $key => $value) 
        {
            $data['todos'][$key]['title'] = join(" ",array_slice($data_filter, 1,count($data_filter)));
            echo join(" ", array_slice($data_filter, 1,count($data_filter)));
        }
        $this->write_data($data);
    }

    public function done_data($data)
    {
        $data_filter = explode(" ",$data);
        $data = $this->get_data();
        $filter_data = array_filter($data['todos'], function($val) use($data_filter){return $val['id']==$data_filter[0];});
        foreach ($filter_data as $key => $value) 
        {
            if($data['todos'][$key]['complete'] == false)
            {
                $data['todos'][$key]['complete'] = true;
            }
        }
        $this->write_data($data);
    }

    public function undone_data($data)
    {
        $data_filter = explode(" ",$data);
        $data = $this->get_data();
        $filter_data = array_filter($data['todos'], function($val) use($data_filter){return $val['id']==$data_filter[0];});
        foreach ($filter_data as $key => $value) 
        {
            if ($data['todos'][$key]['complete'] == true)
            {
                $data['todos'][$key]['complete'] = false;
            }
        }
        $this->write_data($data);
    }

    public function delete_data($data)
    {
        $data_filter = explode(" ",$data);
        $data = $this->get_data();
        $filter_data = array_filter($data['todos'], function($val) use($data_filter){return $val['id']==$data_filter[0];});
        foreach ($filter_data as $key => $value) 
        {
            array_splice($data['todos'], $key, 1);
        }
        $this->write_data($data);
    }

    public function clear_data()
    {
        $clear_data = ["todos"=> []];
        $this->write_data($clear_data);
    }

    public function write_data($new_data)
    {
        $new_data = json_encode($new_data, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__."/todos.json", $new_data);
    }
}


?>