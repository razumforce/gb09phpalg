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
            while (!$this->insertNode($node, $this->root)) {};
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


    public function calculate($var = []) {
        
        if ($this->isEmpty()) {
            throw new \Exception('Tree is empty');
        }

        while ($this->root->value['type'] != 'num') {
            $this->calculateNode($var, $this->root);
        }

        return $this->root->value['value'];

    }

    protected function calculateNode($var, &$subtree) {
        if ($subtree->left->value['type'] != 'ops' && $subtree->right->value['type'] != 'ops') {
            if ($subtree->value['type'] == 'ops') {
                $opLeft = ($subtree->left->value['type'] == 'num') ? $subtree->left->value['value'] : $var[$subtree->left->value['value']];
                $opRight = ($subtree->right->value['type'] == 'num') ? $subtree->right->value['value'] : $var[$subtree->right->value['value']];
                $subtree->value['type'] = 'num';
                switch ($subtree->value['value']) {
                    case '+':
                        $subtree->value['value'] = $opLeft + $opRight;
                        break;
                    case '-':
                        $subtree->value['value'] = $opLeft - $opRight;
                        break;
                    case '*':
                        $subtree->value['value'] = $opLeft * $opRight;
                        break;
                    case '/':
                        $subtree->value['value'] = $opLeft / $opRight;
                        break;
                    case '^':
                        $subtree->value['value'] = pow ($opLeft, $opRight);
                        break;
                    default:
                        throw new \Exception('Wrong ops');
                }
            } else if ($subtree->value['type'] == 'var') {
                $subtree->value['type'] = 'num';
                $subtree->value['value'] =$var[$subtree->value['value']];
            } else {

            } 
        } else if ($subtree->left->value['type'] == 'ops') {
            $this->calculateNode($var, $subtree->left);
        } else {
            $this->calculateNode($var, $subtree->right);
        }

    }


}
