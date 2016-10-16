About team:

  We separate the work of the project. We discuss together about what situation will occur. Design and check the regular expression together.

About project function design:

  We use regular expression to check if the input contains invalid characters.If invalid character caught we return error gracefully.
  We use another regular expression to check if the dividend is zero and out put error message.
  In the calculator it is able to do the basic evaluation with eval() function. And if eval() have something wrong happen we will catch the error and out put error message correctly. 
  Also "--" with be replace with "- -", since eval() function will treat "--" as an error.

Test case

inpuy                | output
-49                  | -49
2+3+4                | 9
2*3*-4               | -24
2*-1*-2*-3           | -12
100-100/100          | 99
3/2+1/3              | 1.83333333333
0/0                  | Division by zero error!
abcd                 | Invalid Expression
one/two              | Invalid Expression
3*-2                 | -6
-2/-3                | 0.66666666666667
1+-1                 | 0
1/    2              | 1/ 2 = 0.5 
1/  02               | Invalid Expression! 
1/0.02               | 1/0.02 = 50
1/0. 02              | Invalid Expression! 
1+2-3*4/5            | 1+2-3*4/5 = 0.6
1+9/0                | Division by zero error! 
- 1                  | Invalid Expression! 
--1                  | Invalid Expression! 
1--1                 | 1--1=2
1.                   | Invalid Expression! 
1+1.                 | Invalid Expression! 
1+.1                 | Invalid Expression! 
1+ 1 1               | Invalid Expression!
(space)              | Invalid Expression! 
(Empty)              | nothing
exit();		     | Invalid Expression!

