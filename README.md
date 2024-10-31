## Установка
make install

## Информация
Для авторизации используется Bearer token, получить его можно при регистрации или авторизации
Не успел выполнить пункт с ТЗ о фоновых задачах, поскольку возникли проблемы с внедрением планировщика задач Cron в проект, но реализовал необходимые для работы этой задачи компоненты:

1) app/Console/Kernel.php 19 стр. - задача на обновление заказов, которые не были оплачены в течении 2 минут.
2) docker/php/schedule - расписание для крона по запуску задач



## Описание API

### Регистрация:
Авторизация: Не требуется

url: localhost/api/registration

method:Post

params:{ email, password}

return: token

### Авторизация:
Авторизация: Не требуется

url: localhost/api/login

method:Post

params:{ email, password}

return: token

### Получить конкретный товар:
Авторизация: Bearer token

url: localhost/api/product/get

method:Post

params:{ id}

return: array

### Получить список товаров:
Авторизация: Bearer token

url: localhost/api/product/list

method:Post

params:{ sort_type (не обязательный, допустимые значения - 'asc','desc') }

return: array

### Добавить товар в корзину:
Авторизация: Bearer token

url: localhost/api/cart/product/add

method:Post

params:{ id }

return: message = 'success'

### Удалить товар из корзины:
Авторизация: Bearer token

url: localhost/api/cart/delete

method:Post

params:{ id }

return: message = 'success'

### Создать заказ:
Авторизация: Bearer token

url: localhost/api/order/create

method:Post

params:{ payment_type(допустимые значения: 'Visa','Mir','Mastercard') }

return: URL для оплаты заказа

### Получить конкретный заказ:
Авторизация: Bearer token

url: localhost/api/order/get

method:Post

params:{ id }

return: array

### Получить список заказов:
Авторизация: Bearer token

url: localhost/api/order/list

method:Post

params:{ sort_type (Не обязательный, допустимые значения: 'asc','desc), status_filter(не обязательный, допустимые значения: 'Awaiting','Paid','Cancelled') }

return: array



