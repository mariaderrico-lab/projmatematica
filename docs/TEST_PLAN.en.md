# Test Planning Report

## Scope
Tests cover the linear algebra algorithms of the PHP web application (`Calculos/` folder), written with PHPUnit. They also cover invalid inputs and impossible operations, checking mathematically correct results and proper handling of expected errors.

## Objectives
Matrices are correctly represented; addition and multiplication are correct for compatible dimensions and return an error message otherwise; transposition, determinant (1x1 and larger) and singular-matrix detection are correct; determined, impossible and indeterminate linear systems are correctly solved/identified; floating-point results stay within tolerance (`assertEqualsWithDelta`); invalid inputs and edge cases are handled; the web interface lets the user enter data, shows results and shows clear messages when an operation cannot be performed.

## Approach
Automated PHPUnit tests run from the command prompt, with three scenario types: **happy paths**, **edge cases** (1x1, identity, null matrix) and **error cases** (invalid data, incompatible dimensions, singular matrix, impossible/indeterminate systems).

## Tests succeed if
Operations return the expected results; incompatible addition/multiplication is rejected; singular matrices are identified; determined systems are solved; invalid inputs produce proper messages; edge cases and decimals are within tolerance; all tests pass; and code coverage of the algorithms is **at least 80%**.

## Tests fail if
No error message is shown for wrong input; any result is mathematically wrong; incompatible operations are allowed; a singular matrix is treated as regular; an impossible system is shown as solvable or an indeterminate one as having a unique solution; edge cases are mishandled; decimal error exceeds the tolerance; tests fail; or coverage is below 80%.

## Environment
Visual Studio Code, Composer, Laravel Herd, Windows, PHP >= 8.4.

## Test cases
See the table (IDs 1–21) in [PLANO_DE_TESTES.md](PLANO_DE_TESTES.md); each case maps to a test file in `tests/`.
