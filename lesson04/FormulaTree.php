<?php

class BinaryNode {

    public $value;
    public $left;
    public $right;
    public $closed;

    public function __construct( $value, $status = false )
    {
        $this->value = $value;
        $this->right = null;
        $this->left = null;
        $this->closed = $status;
    }
}


class FormulaTree {

    protected $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function isEmpty() {
        return $this->root === null;
    }

    public function insert($item) {
        $node = new BinaryNode($item);
        // echo "***\n";
        // var_dump($node);

        if($this->isEmpty()) {
            $this->root = $node;
        } else {
            $result = false;
            while (!$result) {
                $result = $this->insertNode($node, $this->root);
                if (!$result) {
                    echo "WHILE MORE";
                }
            };
        }
    }

    protected function insertNode( $node, &$subtree, $root = true) {

        if($subtree === null) {
            $subtree = $node;
        }

        else {
            if ($subtree->left == null || ($subtree->left->value['type'] == 'ops' && !$subtree->left->closed)) {
                return $this->insertNode($node, $subtree->left, false);
            } else if ($subtree->right == null || ($subtree->right->value['type'] == 'ops' && !$subtree->right->closed)) {
                return $this->insertNode($node, $subtree->right, false);
            } else {
                $subtree->closed = true;
                if ($root) {
                    throw new \Exception('TREE CAPACITY EXCEEDED! CHECK FORMULA!');
                } else {
                    return false; // пробуем еще раз вставить
                }
            }

        }

        return true;
    }

    protected function &findNode($value, &$subtree) {
        if(is_null($subtree)) {
            return false;
        }

        if($subtree->value > $value) {
            return $this->findNode($value, $subtree->left);
        }
        elseif ($subtree->value < $value) {
            return $this->findNode($value, $subtree->right);
        } else {
            return $subtree;
        }


    }

    public function delete($value) {

        if($this->isEmpty()) {
            throw new \Exception('Tree is emtpy');
        }

        $node = &$this->findNode($value, $this->root);

        if($node) {
            $this->deleteNode($node);
        }

        return $this;

    }

    protected function deleteNode( BinaryNode &$node) {
        if( is_null ($node->left)  && is_null($node->right)) {
            $node = null;
        }

        elseif (is_null($node->left)) {
            $node = $node->right;
        }

        elseif (is_null($node->right)) {
            $node = $node->left;
        }

        else {

            if(is_null($node->right->left)) {
                $node->right->left = $node->left;
                $node = $node->right;
            }

            else {
                $node->value = $node->right->left->value;
                $this->deleteNode($node->right->left);
            }

        }

    }


}
