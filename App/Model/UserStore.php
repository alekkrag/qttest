<?php


namespace App\Model;

use Simplon\Mysql\Crud\CrudModelInterface;
use Simplon\Mysql\Crud\CrudStore;
use Simplon\Mysql\MysqlException;
use Simplon\Mysql\QueryBuilder\CreateQueryBuilder;
use Simplon\Mysql\QueryBuilder\DeleteQueryBuilder;
use Simplon\Mysql\QueryBuilder\ReadQueryBuilder;
use Simplon\Mysql\QueryBuilder\UpdateQueryBuilder;

/**
 * @package App\Model
 */
class UserStore extends CrudStore
{
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'users';
    }

    /**
     * @return CrudModelInterface
     */
    public function getModel(): CrudModelInterface
    {
        return new UserModel();
    }

    /**
     * @param CreateQueryBuilder $builder
     *
     * @return UserModel
     * @throws MysqlException
     */
    public function create(CreateQueryBuilder $builder): UserModel
    {
        /** @var UserModel $model */
        $model = $this->crudCreate($builder);

        return $model;
    }

    /**
     * @param ReadQueryBuilder|null $builder
     *
     * @return UserModel[]|null
     * @throws MysqlException
     */
    public function read(?ReadQueryBuilder $builder = null): ?array
    {
        /** @var UserModel[]|null $response */
        $response = $this->crudRead($builder);

        return $response;
    }

    /**
     * @param ReadQueryBuilder $builder
     *
     * @return null|UserModel
     * @throws MysqlException
     */
    public function readOne(ReadQueryBuilder $builder): ?UserModel
    {
        /** @var UserModel|null $response */
        $response = $this->crudReadOne($builder);

        return $response;
    }

    /**
     * @param UpdateQueryBuilder $builder
     *
     * @return UserModel
     * @throws MysqlException
     */
    public function update(UpdateQueryBuilder $builder): UserModel
    {
        /** @var UserModel|null $model */
        $model = $this->crudUpdate($builder);

        return $model;
    }

    /**
     * @param DeleteQueryBuilder $builder
     *
     * @return bool
     * @throws MysqlException
     */
    public function delete(DeleteQueryBuilder $builder): bool
    {
        return $this->crudDelete($builder);
    }

    /**
     * @param int $id
     *
     * @return null|UserModel
     * @throws MysqlException
     */
    public function customMethod(string $search): ?array
    {
        $query = 'SELECT name, email FROM ' . $this->getTableName() . ' WHERE name LIKE :name OR email LIKE :email  ';

        if ($result = $this->getCrudManager()->getMysql()->fetchRowMany($query, ['name' => "%{$search}%", 'email' => "%{$search}%"])) {
            return $result;
        }

        return null;
    }
}