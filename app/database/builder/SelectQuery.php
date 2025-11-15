<?php 
namespace app\database\builder;

class SelectQuery
{
    private string $fields;
    private string $table;
    private array $where = [];
    private array $binds = [];
    private string $order;
    private int $limit;
    private int $offset;
    private string $limits;
    public static function select(string $fields = '*'): self
    {
        $self = new self;
        $self->fields = $fields;
        return $self;
    }
    public function from(string $table): self
    {
        $this->table = $table;
        return $this;
    }
    public function where(string $field, string $operator, string | int $value, ?string $logic):self
    {
        $placeholder = '';
        $placeholder = $field;

        if (str_contains($placeholder, '.')) {
            $placeholder = substr($field, strpos($field, '.') + 1);
        }

        $this->where[] = "{$field} {$operator} :{$placeholder} {$logic}";
        $this->binds[$placeholder] = $value;
        return $this;
    }
    public function order (string $field, string $typeOrder = 'asc'): self
    {
        $this->order = "order by {$field} {$typeOrder}";
        return $this;
    }
     public function createQuery()
    {
        if (!$this->fields) {
            throw new \Exception("Por favor informe os campos a serem selecionados na consulta");
        }
        if (!$this->table) {
            throw new \Exception("Por favor informe o nome da tabela");
        }
        $query = '';
        $query = 'select ';
        $query .= $this->fields . ' from ';
        $query .= $this->table;
        $query .= (isset($this->where) and (count($this->where) > 0)) ? ' where ' . implode(' ', $this->where) : '';
        $query .= $this->order ?? '';
        $query .= $this->limits ?? '';
        return $query;
    }
    public function limit(int $limit, int $offset): ?self
    {
        $this->limit = $limit;
        $this->offset = $offset;
        $this->limits = " limit {$this->limit} offset {$this->offset}";
        return $this;
    }
    
}