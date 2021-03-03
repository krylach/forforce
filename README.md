# SQL запросы
### Сумма баланса всех номеров определённого клиента (ключ {client.id}):

SELECT clients.id, sum(numbers.balance) as sum_balance, clients.name FROM numbers
INNER JOIN client_has_numbers ON client_has_numbers.number_id = numbers.id
INNER JOIN clients ON client_has_numbers.client_id = clients.id
WHERE client_has_numbers.client_id = {client.id}


### Количество номеров определёного оператора, по его коду (ключ {operator.id}):

SELECT count(*) as count_numbers, operators.name FROM numbers
INNER JOIN operators ON operators.id = numbers.operator_id
WHERE operators.code = {operator.id}


### Количество номеров у определённого пользователя (ключ {client.id}):

SELECT count(*) as count_numbers, clients.name FROM numbers
INNER JOIN client_has_numbers ON client_has_numbers.number_id = numbers.id
INNER JOIN clients ON client_has_numbers.client_id = clients.id
WHERE client_has_numbers.client_id = {client.id}


### вывести имена 10 пользователей с максимальным балансом на счету:

SELECT clients.id as client_id, clients.name, numbers.balance FROM numbers
INNER JOIN client_has_numbers ON client_has_numbers.number_id = numbers.id
INNER JOIN clients ON client_has_numbers.client_id = clients.id
ORDER BY numbers.balance DESC
LIMIT 0, 10
