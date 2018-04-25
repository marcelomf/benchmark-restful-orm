#### The goal of this project is a languages/frameworks benchmark.

#### The tool used for http test/stress is bombardier written in GOlang

#### Results:

| Lang/Framework       | List req/sec  | Update req/sec | List Latency | Update Latency |
| -------------------- |:-------------:|:--------------:|:------------:| --------------:|
| GO/gorm+echo         | 26181.43 |5023.64|19.11ms|101.47ms|
| GO/xorm+iris         | 5856.50|16650.17|85.24ms|30.41ms| 
| NodeJS/express       | 1863.44 |1467.77| 263.98ms |332.68ms| 
| NodeJS/graojs        | 2034.23 |1126.83|243.13ms|437.84ms| 
| NodeJS/loopback      |1656.08|30.34|295.95ms|6.81s| 
| PHP/phalcon          |1506.15|726.26|472.22ms|1.00s| 
| PHP/Lumen            | 332.01 |358.36| 1.89s |1.68s| 
| PHP/Lumen Apache 7.2 | 750.28 |669.99| 659.82ms |736.90ms| 
| PHP/Symfony 4        | 195.01|4.51| 3.03s |48.83s| 
| Ruby/Rails API 5     |390.10|266.41|2.75s|4.39s| 
| Python/Flask         | 324.61 |190.14|1.91s|3.05s| 
| Java/Spring          |1347.21|2127.15|362.95ms|232.43ms| 
| .NET Core 2          |849.42|101.07|573.91ms|3.94s| 
