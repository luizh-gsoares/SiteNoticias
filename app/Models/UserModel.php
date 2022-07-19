<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    // Atributos de configuração
    protected $table = 'usuarios';
    protected $allowedFields = ['user', 'senha'];

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Metodo GET
    public function getUser($user, $senha)
    {
        return $this->asArray()
            ->where([
                'user' => $user,
                'senha' => md5($senha)
            ])
            ->first();
    }
}
