<?php

namespace Core\Model;

use RuntimeException;
use Laminas\Db\TableGateway\TableGatewayInterface;

abstract class AbstractCoreModelTable
{
    protected $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function getBy(array $params)
    {
        $rowset = $this->tableGateway->select($params);
        $row = $rowset->current();

        if (!$row) {
            throw new RuntimeException('Could not find row.');
        }

        return $row;
    }

    public function save(array $data)
    {
        if (isset($data['id'])) {
            $id = (int) $data['id'];

            if (!$this->getBy(['id' => $id])) {
            throw new RuntimeException("Can not update identifier {$id}; does not exist.");
            }

            $this->tableGateway->update($data, ['id' => $id]);

            return $this->getBy(['id' => $id]);
        }

        $this->tableGateway->insert($data);

        return $this->getBy(['id' => $this->tableGateway->getLastInsertValue()]);
    }

    public function delete(int $id)
    {
        $this->tableGateway->delete(['id' => $id]);
    }
}