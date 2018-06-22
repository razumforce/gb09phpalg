<?php

// Обратная Польская Нотация
class Formula {

  private const OPS_MAP = ['+', '-', '*', '/', '^'];
  private const VAR_MAP = ['x', 'y', 'z'];
  private const OPS_WEIGHT = ['+' => 1, '-' => 1, '*' => 2, '/' => 2, '^' => 3];
    
  protected $rpn;

  public function __construct() {
    $this->rpn = [];
  }

  public function generate($formula) {
    $stack = new SplStack();

    foreach ($formula as $token) {
      if (!in_array($token, self::OPS_MAP) && $token != '(' && $token != ')') {
        $this->rpn[] = $token;
      } else if ($token == '(') {
        $stack->push($token);
      } else if ($token == ')') {
        while ($stack->top() != '(') {
          $this->rpn[] = $stack->pop();
        }
        $stack->pop();
      } else {
        while (!$stack->isEmpty() && self::OPS_WEIGHT[$token] <= self::OPS_WEIGHT[$stack->top()]) {
          $this->rpn[] = $stack->pop();
        }
        $stack->push($token);
      }
    }

    while (!$stack->isEmpty()) {
      $this->rpn[] = $stack->pop();
    }

  }

  public function calculate($var) {
    $stack = new SplStack();

    foreach ($this->rpn as $token) {
      if (!in_array($token, self::OPS_MAP)) {
        if (in_array($token, self::VAR_MAP)) {
          $stack->push($var[$token]);
        } else {
          $stack->push($token);
        }
      } else {
        $rightOperand = $stack->pop();
        $leftOperand = $stack->pop();
        switch ($token) {
          case '+':
            $stack->push($leftOperand + $rightOperand);
            break;
          case '-':
            $stack->push($leftOperand - $rightOperand);
            break;
          case '*':
            $stack->push($leftOperand * $rightOperand);
            break;
          case '/':
            $stack->push($leftOperand / $rightOperand);
            break;
          case '^':
            $stack->push(pow($leftOperand, $rightOperand));
            break;
          default:
            throw new \Exception('Wrong ops');
        }
      }
    }

    return $stack->pop();
  }

}


// берем туже формулу, что и в случае генерации дерева
$formula = ['(', 'x', '+', '42', ')', '^', '2', '+', '7', '*', 'y', '-', 'z'];


$f = new Formula();
$f->generate($formula);

$var = ['x' => 1, 'y' => 5, 'z' => 10];

echo $f->calculate($var) . "\n";




