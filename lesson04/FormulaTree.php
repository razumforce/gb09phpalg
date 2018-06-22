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

    private const OPS_MAP = ['+', '-', '*', '/', '^'];
    private const VAR_MAP = ['x', 'y', 'z'];
    private const OPS_WEIGHT = ['+' => 1, '-' => 1, '*' => 2, '/' => 2, '^' => 3];
    
    protected $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function isEmpty() {
        return $this->root === null;
    }

    public function generate($formula) {
        $formulaDirect = $this->parseDirect($formula);

        foreach ($formulaDirect as $token) {
          if (in_array($token, self::OPS_MAP)) {
            $type = 'ops';
          } else if (in_array($token, self::VAR_MAP)) {
            $type = 'var';
          } else {
            $type = 'num';
          }
          $this->insert(['type' => $type, 'value' => $token]);
        }
    }

    protected function parseDirect($formula) {
        $ops = new SplStack();
        $oper = new SplStack();

        foreach($formula as $token) {
            if (!in_array($token, self::OPS_MAP) && $token != '(' && $token != ')') {
                $oper->push($token);
            } else if ($token == '(' || $ops->isEmpty() || self::OPS_WEIGHT[$token] > self::OPS_WEIGHT[$ops->top()]) {
                $ops->push($token);
            } else if ($token == ')') {
                while ($ops->top() != '(') {
                    $operator = $ops->pop();
                    $rightOperand = $oper->pop();
                    $leftOperand = $oper->pop();
                    $operand = [];
                    $operand[] = $operator;
                    $operand[] = $leftOperand;
                    $operand[] = $rightOperand;
                    $oper->push($operand);
                }
                $ops->pop();
            } else {
                while (!$ops->isEmpty() && self::OPS_WEIGHT[$token] <= self::OPS_WEIGHT[$ops->top()]) {
                    $operator = $ops->pop();
                    $rightOperand = $oper->pop();
                    $leftOperand = $oper->pop();
                    $operand = [];
                    $operand[] = $operator;
                    $operand[] = $leftOperand;
                    $operand[] = $rightOperand;
                    $oper->push($operand);
                }
                $ops->push($token);
            }
        }

        while (!$ops->isEmpty()) {
            $operator = $ops->pop();
            $rightOperand = $oper->pop();
            $leftOperand = $oper->pop();
            $operand = [];
            $operand[] = $operator;
            $operand[] = $leftOperand;
            $operand[] = $rightOperand;
            $oper->push($operand);
        }

        $result = $oper->top();
        $oper->pop();

        return $this->flatten($result);
    }

    private function flatten($array) {
        if (!is_array($array)) {
            return array($array);
        }

        $result = array();
        foreach ($array as $value) {
            $result = array_merge($result, $this->flatten($value));
        }

        return $result;
    }


    protected function insert($item) {
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
