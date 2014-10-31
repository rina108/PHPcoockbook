<?php
/**
 * Created by PhpStorm.
 * User: neov
 * Date: 31.10.14
 * Time: 10:30
 */
/**
 * Задача: определить метод который вызывается когда объект уничтожен.
 * Например: вы хотите автоматически сохранить информацию из базы данных
 * в объект когда он уничточжен.
 *
  */

//Объект автоматически уничтожается когда скрипт закончился. Для принудительного уничтожения объекта можно использовать unset()

$object = new Object;

// какой-то код

unset($object);

/**
 * Чтобы php вызывал метод уничтожения когда объект отработал, определите
 * метод __destruct();
 */

class Object{
    function __destruct(){

    }
}
/**
 * Обычно не используют ручное удаление объекта из памяти, но если у вас большой
 * цикл, то тогда можно использовать функцию unset(), она поможет при опасности
 * чрезмерного переполнения памяти.
 *
 * Также PHP поддерживает деструкторы объектов. Деструкторы ведут себя примерно
 * также как и конструкторы, за исключением ситуаций когда объект уже удалён.
 * Если вы ещё не удалили объект функцией unset(), PHP вызовет деструктор если
 * если определит  что объект больше не используется. Возможно это произойдёт
 * когда скрипт достигнет конца, но возможно и раньше.
 *
 * К примеру, можно сделать деструктор который отключает от базы данных и ос-
 * вобождает соединение. В отличии от конструктора вы не можете помещать инфор-
 * в деструктор, так как вы не можете точно знать когда будет запущен.
 *
 * Поэтому, если ваш деструктор требует некой специфической информации,
 * храните её как метод.
 *
 */

class Database{
    function __destruct(){
        dba_close($this->handle);
    }
}

/**
 *  Деструкторы исполняются перед тем как PHP завершит запрос и прекратит переда
 * чу данных. Поэтому, вы можете выводить куда-то информации из него, писать в
 *  базу данных или к примеру делать какую-то отправку на удаленный сервер.
 *   Также невозможно предусмотреть, что PHP удалит объект в каком-то определен-
 * ном порядке. По этой же причине, вы не можете использовать какой-то другой об
 * ъект в деструкторе, потому что PHP уже удалил его. Это не приведёт к полной
 * остановке программы, но может спровоцировать не предвиденное поведение кода.
 */