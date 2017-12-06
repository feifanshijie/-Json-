<?php
/**
 * ============================================================
 * TODO:[Class Mysql PDO 2017/04/01  V0.1]
 * ============================================================
 */
namespace Framework\Drive;

use Framework\BaseInterface\DBInterface;

class MySqlDrive implements DBInterface {

    public static $connect_object;
    public $result;
    private $_pdo;
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass = '';
    private $db_pfix = '';
    public static $son;

    private $_sql = '';

    private function __construct($db_name)
    {
        $config         = D[$db_name];

        $this->db_host  = $config['db_host'];
        $this->db_name  = $config['db_name'];
        $this->db_user  = $config['db_user'];
        $this->db_pass  = $config['db_pass'];
        $this->db_pfix  = $config['db_pfix'];

        $this->_pdo = new \PDO("mysql:host=$this->db_host;dbname=$this->db_name","{$this->db_user}", "{$this->db_pass}");
        $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->_pdo->exec('set names utf8');
    }

    private function __clone(){}

    public static function connect($db_name = 'blog')
    {
        if (self::$connect_object === null)
        {
            self::$connect_object = new self($db_name);
        }

        return self::$connect_object;
    }

    public function getInstance()
    {

    }

    public function pdo_exec($sql)
    {
        $res = $this->db->query($sql);
        if ($res) {
            $res->setFetchMode(\PDO::FETCH_ASSOC);
            $result = $res->fetchAll();
        } else {
            $result = null;
        }
        return $result;
    }

    /**
     * PDO:返回最后一个插入ID
     */
    public function pdo_lastInsertId(String $name = null)
    {
        return $this->_pdo->lastInsertId($name);
    }

    //TODO:事物回滚
    public function errorCode()
    {
        
    }

    //TODO:SQL格式化
    public function pdo_prepare(string $sql = '',string $param = '')
    {
        $this->result = self::$connect_object->_pdo->prepare($sql);
        return $this->result->execute([$param]);
    }

    //TODO:开启事物
    public function beginTransaction()
    {
        $this->_pdo->beginTransaction();
    }

    //TODO:提交事物
    public function commit()
    {
        $this->_pdo->commit();
    }

    //TODO:事物回滚
    public function rollBack()
    {
        $this->_pdo->rollBack();
    }

    //TODO:取第一个字段
    public function FindRow()
    {
        return $this->result->fetchColumn();
    }

    //TODO:获取一个标准对象
    public function FindObject()
    {
        return $this->result->fetch(\PDO::FETCH_OBJ);
    }

    //TODO:获取一行
    public function FindOne()
    {
        return $this->result->fetch(\PDO::FETCH_COLUMN);
    }


    //TODO:获取一个标准对象
    public function FindAll()
    {
        echo $this->_sql;
        $this->pdo_prepare($this->_sql, '');
        return $this->result->fetchAll(\PDO::FETCH_ASSOC);
    }
    //TODO:获取索引(列)
    public function FindColumn()
    {
        return $this->result->fetchAll(\PDO::FETCH_COLUMN, 0);
    }

    //TODO:获取一列
    public function FindIndex()
    {
        return $this->result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * ============================================================
     * TODO: 简单查询
     * ============================================================
     * @param string  $table  表名
     * @param array   $where  查询条件
     * @param string  $field  返回的字段
     * @param array   $limit  起止
     * @return boolean
     * ============================================================
     * Example
     * SimpleInsert(['id'=>1,'name'=>'eric'])
     * ============================================================
     */
    public function SimpleQuery(string $table = '', string $field = '', array $where = [], array $limit = [])
    {
        $where_str = '';
        $bind_str = '';
        if(count($where) > 0)
        {
            $where_str = ' WHERE ';
            foreach ($where as $k => $v)
            {
                $where_str .= $k.' = ? '.' AND';
                $bind_str .= $v.',';
            }
        }
        if(!empty($limit))
        {
            $limit_str = ' LIMIT ' . $limit[0].','.$limit[1];
        }else{
            $limit_str = '';
        }

        $where_str = trim($where_str, 'AND');
        $bind_str  = trim($bind_str, ',');

        $sql = 'SELECT '. $field . ' FROM '. $table . $where_str . $limit_str;
        $this->pdo_prepare($sql,$bind_str);

        if($this->result->queryString)
        {
            return self::$connect_object;
        }
        return false;
    }

    /**
     * ============================================================
     * TODO: 简单插入
     * ============================================================
     * @param  string $table 表
     * @param  array  $data  需要增加的数据
     * @return boolean
     * ============================================================
     * Example
     * SimpleInsert(['id'=>1,'name'=>'eric'])
     * ============================================================
     */
    public function SimpleInsert(string $table = '', array $data = [])
    {
        $key = '';
        $value = '';
        $bind = [];
        if(count($data) > 0)
        {
            foreach ($data as $k => $v)
            {
                $key .= $k.',';
                $value .= '?'.',';
                array_push($bind,$v);
            }
        }
        $key_str = trim($key, ',');
        $value_str = trim($value, ',');
        $sql = 'INSERT INTO '. $table . '('.$key_str .') VALUES (' . $value_str. ')';
        return $this->_pdo->prepare($sql)->execute($bind);
    }

    /**
     * ============================================================
     * TODO: 简单更新
     * ============================================================
     * @param  string $table 表
     * @param  array  $where 更新条件
     * @param  array  $data  需要更新的字段
     * @return boolean
     * ============================================================
     * Example
     * SimpleDelete(['id'=>1])
     * ============================================================
     */
    public function SimpleUpdate(string $table = '', array $where = [], array $data = [])
    {
        $sql = 'UPDATE FROM '. $table . $where. 'SET' . $data;
    }

    /**
     * ============================================================
     * TODO: 简单删除
     * ============================================================
     * @param  string $table 数据表
     * @param  array  $where 查询条件
     * @return boolean
     * ============================================================
     * Example
     * SimpleDelete(['id'=>1])
     * ============================================================
     */
    public function SimpleDelete(string $table = '', array $where = [], array $bind = [])
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $this->pdo_prepare($sql,$bind);
        if($this->result->queryString)
        {
            return true;
        }
        return false;
    }

    /**
     * ============================================================
     * TODO: 简单分页
     * ============================================================
     * @param  string $table 数据表
     * @param  int    $num   每页多少条数据
     * @param  array  $where 查询条件
     * @return array  $result
     * $result['total']   共有多少条数据
     * $result['page']    共有多少页
     * =======================
     * Example
     * SimplePaging('table', 10, ['id' => 1]);
     * ============================================================
     */
    public function SimplePaging(string $table = '', int $num = 1,array $where = [])
    {
        $bind_str = '';
        if(count($where) > 0)
        {
            $where_str = ' WHERE ';
            foreach ($where as $k => $v)
            {
                $where_str .= $k.' = ? '.' AND';
                $bind_str .= $v.',';
            }
        }
        else
        {
            $where_str = '';
        }
        $sql = "SELECT count(*) FROM {$table} {$where_str}";
        $this->result = self::$connect_object->_pdo->prepare($sql);
        $this->result->execute([$bind_str]);
        $result['total'] = $this->result->fetchColumn();
        $result['page'] = ceil($result['total']/$num);
        return $result;
    }

    public function SimpleJoin(array $table = [], array $field = [], array $on = [], string $where = '', array $limit = [])
    {
        $sql = "SELECT * FROM {$table[0]}";
        for ($i = 0;$i<count($table);$i ++)
        {
            $sql.="LEFT JOIN {$table[$i+1]} ON {$on[$i]}";
        }
        $sql .= $where;
        echo $sql;
    }
    /**
     * ============================================================
     * TODO: 简单Sql
     * ============================================================
     * @param    string $sql
     * @param    array  $bind
     * @return   mixed
     * ============================================================
     * Example
     * $sql  = "SELECT * FROM table WHERE id = ? AND name = ?";
     * $bind = [1,'hello'];
     * SimpleSql($sql, $bind);
     * ============================================================
     */
    public function SimpleSql(string $sql = '', array $bind = [])
    {

    }

    /**
     * ============================================================
     * TODO: 联表查询
     * ============================================================
     * @param array $table
     * @param array $Join
     * =======================
     * Example
     * Join(['table1','table2'],[]);
     * ============================================================
     */
    public function Join(array $table = [], array $Join = [])
    {
        return $this;
    }
//
    public function field(string $field = '*')
    {
        $this->_sql .= 'SELECT ' .$field. ' FROM test ';
        return $this;
    }

    protected $where_flag = false;
    protected $bind_param = [];

    protected $table = '';
    public function table($table = '')
    {
        $this->table = $table;
        return self::$connect_object;
    }

    public function group($group)
    {
        $this->_sql .= " GROUP BY {$group}";
        return $this;
    }

    public function order($order, $seq = 'DESC')
    {
        $this->_sql .= " ORDER BY {$order} {$seq}";
        return $this;
    }

    //TODO:select 查询
    public function select($field = '*')
    {
//        foreach ($field as $k => $v)
//        {
//            $field .= $table.'.'.$v;
//        }

        $this->_sql .= "SELECT {$field} FROM {$this->table}";
        return $this;
    }

    //TODO:where 查询
    public function where($where = [])
    {
//
//        if(count($where) > 0)
//        {
//            foreach ($where as $k => $v)
//            {
//                if($this->where_flag == false)
//                {
//                    $this->_sql .= ' WHERE ';
//                    $this->where_flag = true;
//                }
//                else
//                {
//                    $this->_sql .= ' AND ';
//                }
//                $this->_sql .= $k.' = ? ';
//                array_push($this->bind_param, $v);
//            }
//            return $this;
//        }

        return $this;
    }


    public function show_sql()
    {
        return fw_iterator($this->_sql);
    }

    public function show_param()
    {
        return fw_iterator($this->bind_param);
    }
}