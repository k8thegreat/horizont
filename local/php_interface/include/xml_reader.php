<?php

/*
    Родительский класс для XML импортеров.
*/
class AbstractAdvertisementXMLReader {

    protected $reader;
    public $result = array();
    public $source;
    public $counter_offer;
    public $limit_offer;
    public $step_limit_offer;
    public $deleted;

    // события
    protected $_eventStack = array();

    /*
        Конструктор класса.

        Создает сущность XMLReader и загружает xml, либо бросает исключение
    */
    public function __construct($xml_path) {

        $this->reader = new XMLReader();

        if(is_file($xml_path)) {
            $this->reader->open($xml_path);
            $this->source = $xml_path;
            $this->counter_offer = 0;
            //$this->limit_offer = 10000;
            $this->step_limit_offer=500;
        }
        else throw new Exception('XML file {'.$xml_path.'} not exists!');
    }

    /*
        Потоково парсит xml и вызывает методы для определенных элементов

        напр.
            при обнаружении элемента <Rubric> попытается вызвать метод parseRubric

        все методы парсинга должны быть public или protected.
    */
    public function parse() {

        $this->reader->read();
        $step_counter = 0;
        while($this->reader->read()){// && ($this->counter_offer < $this->limit_offer)) {
            if($this->reader->nodeType == XMLREADER::ELEMENT) {
                $fnName = 'parse' . $this->reader->localName;

                if(method_exists($this, $fnName)) {

                    $lcn = $this->reader->name;

                    // пробежка по детям
                    if($this->reader->name == $lcn && $this->reader->nodeType != XMLREADER::END_ELEMENT) {
                        // вызываем функцию парсинга
                        $this->{$fnName}();
                        // стреляем событием по названию элемента
                        $this->fireEvent($fnName);
                        // стреляем событием по окончанию парсинга элемента
                        $this->fireEvent('afterParseElement', array('name' => $lcn));
                    }
                }

                if($this->reader->localName == "offer") {
                    $this->counter_offer++;
                    $step_counter++;
                }
                if($step_counter == $this->step_limit_offer){
                    //sleep(5);
                    $step_counter = 0;
                }

            }
        }
        $this->reader->close();
        $this->fireEvent('afterParse');
    }

    /*
        Вызывается при каждом распознавании
    */
    public function onEvent($event, $callback) {

        if(!isset($this->_eventStack[$event])) //!is_array($this->_eventStack[$event]))
            $this->_eventStack[$event] = array();

        $this->_eventStack[$event][] = $callback;
        return $this;
    }

    /*
        Выстреливает событие
    */
    public function fireEvent($event, $params = null, $once = false) {

        if($params == null) $params = array();

        $params['context'] = $this;

        if(!isset($this->_eventStack[$event]))
            return false;

        $count = count($this->_eventStack[$event]);

        if(isset($this->_eventStack[$event]) && $count > 0) {
            for($i = 0; $i < $count; $i++) {
                call_user_func_array($this->_eventStack[$event][$i], $params);

                if($once == true) {
                    array_splice($this->_eventStack[$event], $i, 1);
                }
            }
        }
    }

    /*
        Получить результаты парсинга
    */
    public function getResult() {
        return $this->result;
    }

    /*
        Очистить результаты парсинга
    */
    public function clearResult() {
        $this->result = array();
    }

}
class fileXMLReader extends AbstractAdvertisementXMLReader{

    public function parseoffer() {
        if($this->reader->nodeType == XMLREADER::ELEMENT && $this->reader->localName == 'offer') {
            $id = $this->reader->getAttribute("internal-id");
            $doc = new DOMDocument('1.0', 'UTF-8');
            $this->result['id'] = $id;
            $node = $this->reader->expand();
            if($node)
            $this->result['properties'] = xml2array(simplexml_import_dom($doc->importNode($node, true)));
            //print_r($this->result);

        }
    }
    public function parseobject() {
        if($this->reader->nodeType == XMLREADER::ELEMENT && $this->reader->localName == 'object') {
            $id = $this->reader->getAttribute("innerid");
            $doc = new DOMDocument('1.0', 'UTF-8');
            $this->result['id'] = $id;
            $node = $this->reader->expand();
            if($node)
                $this->result['properties'] = xml2array(simplexml_import_dom($doc->importNode($node, true)));
            //print_r($this->result);

        }
    }
}
function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}
