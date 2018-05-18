#include <iostream>
#include <string>

using namespace std;

int main(){
  //declare a string
  string greetStr ("Hello std::string!");
  cout << greetStr <<endl;

  // get input
  cout << "enter a line of text: " << endl;
  string firstLine;
  getline(cin, firstLine);

  //Getline Extracts characters from is and stores them into str until the delimitation character delim is found (or the newline character, '\n', for (2)).
  // it takes object from which characters are extracted
  // and where the string is stored
 
  cout << "Enter another: " << endl;
  string secondLine;
  getline(cin, secondLine);

  cout << "Result of concatentation: " << endl;
  string concatString = firstLine + " " + secondLine;
  cout << concatString << endl;

  cout << "Copy of the concatented string: " << endl;
  string aCopy;
  aCopy = concatString;
  cout << aCopy << endl;

  cout <<"Length of concat string " << concatString.length() << endl;

  return 0;

}