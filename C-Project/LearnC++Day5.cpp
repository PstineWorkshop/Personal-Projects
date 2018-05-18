#include <iostream>

int main(){
  using namespace std;
  // Math Operations in C++
  int one = 22;
  int two = 5;
  int addNums = one + two;
  int subtractNums = one - two;
  int multiplyNums = one * two;
  int divideNums = one / two;
  int modulosNums = one % two;

  cout << addNums <<" " << subtractNums <<" "<<multiplyNums<< " " <<divideNums<<" " <<" "<<modulosNums << endl;

  //Math operations based off user input
  cout << "Enter two integers: " << endl;
  int num1 = 0;
  int num2 = 0;
  cin >> num1;
  cin >> num2;

  cout << num1 << " + " << num2 << " = " << num1 + num2 << endl;
  cout << num1 << " - " << num2 << " = " << num1 - num2 << endl;
  cout << num1 << " * " << num2 << " = " << num1 * num2 << endl;
  cout << num1 << " / " << num2 << " = " << num1 / num2 << endl;

  // ++someVariable increment prefix
  // someVariable++ increment postfix
   // --someVariable decrement prefix
  // someVariable-- decrement postfix




  return 0;
}