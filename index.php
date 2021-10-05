<?php
require_once("header.php")
?>
<main>
    <div class="" style="display: flex">
        <div id="sensor-filter" class="filter">
            <div style="padding: 0.5em">
                <table class="filter-table">
                    <tr><td><button class="btn btn-outline-primary btn-sm" onclick="drop_filters()" style="width: 236px">Сбросить фильтры</button></td></tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="countSensor" checked class="custom-checkbox"><label for="countSensor" id="sensorsCount">Датчики</label><br>
                            <input type="checkbox" id="countDevice" checked class="custom-checkbox"><label for="countDevice" id="devicesCount">Приборы</label><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="label_productTypeSelect">&nbsp;Тип датчика или прибора</label><br>
                            <select id="productTypeSelect" style="width: 230px">
                                <option value="0">Выбрать тип</option>
                                <optgroup label='Датчики'></optgroup>
                                <optgroup label='Приборы'></optgroup>
                            </select>
                        </td>
                    </tr>
                    <tr><td><label><b>Общие параметры</b></label></td></tr>
<!--                    <tr><td>Погрешность измерения, %</td></tr>-->
<!--                    <tr><td>-->
<!--                            <label for="amount-infelicity"></label>-->
<!--                            <input id="amount-infelicity" class="custom-slider table_filter" min="0" max="100"><a style="color: var(--theme-color)"></a>-->
<!--                        </td></tr>-->
<!--                    <tr><td><div id="range-infelicity"></div></td></tr>-->
                    <tr>
                        <td>
                            <label for="filter_max_measurement_error">Погрешность измерения, %</label>
                            <input type="number" min="0" max="100" step="0.1" class="form-control form-control-sm table_filter" id="filter_max_measurement_error" placeholder="Погрешность измерения, %">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_max_measurement">Верхний диапазон измерений</label>
                            <input type="number" class="form-control form-control-sm table_filter" id="filter_max_measurement" placeholder="Верхний диапазон измерений">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_min_measurement">Нижний диапазон измерений</label>
                            <input type="number" class="form-control form-control-sm table_filter" id="filter_min_measurement" placeholder="Нижний диапазон измерений">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_unit_of_measuring">Единица измерения величины</label>
                            <input class="form-control form-control-sm table_filter" id="filter_unit_of_measuring" placeholder="Единица измерения величины">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_resource">Требуемый ресурс, ч</label>
                            <input type="number" min="0" class="form-control form-control-sm table_filter" id="filter_resource" placeholder="Требуемый ресурс, ч">
                        </td>
                    </tr>
<!--                    <tr><td>Верхний диапазон измерений</td></tr>-->
<!--                    <tr><td>-->
<!--                            <label for="amount-max_measurement"></label>-->
<!--                            <input type="text" id="amount-max_measurement" class="custom-slider table_filter" placeholder="Введите значение">-->
<!--                        </td></tr>-->
<!--                    <tr><td><div id="range-max_measurement"></div></td></tr>-->
<!--                    <tr><td>Нижний диапазон измерений</td></tr>-->
<!--                    <tr><td>-->
<!--                            <label for="amount-min_measurement"></label>-->
<!--                            <input type="text" id="amount-min_measurement" class="custom-slider table_filter">-->
<!--                        </td></tr>-->
<!--                    <tr><td><div id="range-min_measurement"></div></td></tr>-->
<!--                    <tr><td>Требуемый ресурс, ч</td></tr>-->
<!--                    <tr><td>-->
<!--                            <label for="amount-resource"></label>-->
<!--                            <input type="text" id="amount-resource" class="custom-slider table_filter">-->
<!--                        </td></tr>-->
<!--                    <tr><td><div id="range-resource"></div></td></tr>-->
                    <!-- Диапазон температур-->
                    <tr>
                        <td>
                            <label for="filter_max_temperature">Верхний диапазон температур внешней среды</label>
                            <input type="number" class="form-control form-control-sm table_filter" id="filter_max_temperature" placeholder="Верхний диапазон температур">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_min_temperature">Нижний диапазон температур внешней среды</label>
                            <input type="number" class="form-control form-control-sm table_filter" id="filter_min_temperature" placeholder="Нижний диапазон температур">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_temperature_unit">Единица измерения температуры внешней среды</label>
                            <input class="form-control form-control-sm table_filter" id="filter_temperature_unit" placeholder="Единица измерения температуры">
                        </td>
                    </tr>
<!--                    <tr><td>Верхний диапазон температур внешней среды</td></tr>-->
<!--                    <tr><td>-->
<!--                            <label for="amount-max_temperature"></label>-->
<!--                            <input type="text" id="amount-max_temperature" class="custom-slider table_filter">-->
<!--                        </td></tr>-->
<!--                    <tr><td><div id="range-max_temperature"></div></td></tr>-->
<!--                    <tr><td>Нижний диапазон температур внешней среды</td></tr>-->
<!--                    <tr><td>-->
<!--                            <label for="amount-min_temperature"></label>-->
<!--                            <input type="text" id="amount-min_temperature" class="custom-slider table_filter">-->
<!--                        </td></tr>-->
<!--                    <tr><td><div id="range-min_temperature"></div></td></tr>-->
                    <!--                    // Габаритные размеры и вес-->
                    <tr>
                        <td>
                            <label for="filter_max_length">Максимальная длина</label>
                            <input type="number" min="0" class="form-control form-control-sm table_filter" id="filter_max_length" placeholder="Максимальная длина">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_max_width">Максимальная ширина</label>
                            <input type="number" min="0" class="form-control form-control-sm table_filter" id="filter_max_width" placeholder="Максимальная ширина">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_max_height">Максимальная высота</label>
                            <input type="number" min="0" class="form-control form-control-sm table_filter" id="filter_max_height" placeholder="Максимальная высота">
                        </td>
                    </tr>
                    <!--                    <tr><td>Максимальная длина</td></tr>-->
                    <!--                    <tr><td>-->
                    <!--                            <label for="amount-max_length"></label>-->
                    <!--                            <input type="text" id="amount-max_length" class="custom-slider table_filter">-->
                    <!--                        </td></tr>-->
                    <!--                    <tr><td><div id="range-max_length"></div></td></tr>-->
                    <!--                    <tr><td>Максимальная ширина</td></tr>-->
                    <!--                    <tr><td>-->
                    <!--                            <label for="amount-max_width"></label>-->
                    <!--                            <input type="text" id="amount-max_width" class="custom-slider table_filter">-->
                    <!--                        </td></tr>-->
                    <!--                    <tr><td><div id="range-max_width"></div></td></tr>-->
                    <!--                    <tr><td>Максимальная высота</td></tr>-->
                    <!--                    <tr><td>-->
                    <!--                            <label for="amount-max_height"></label>-->
                    <!--                            <input type="text" id="amount-max_height" class="custom-slider table_filter">-->
                    <!--                        </td></tr>-->
                    <!--                    <tr><td><div id="range-max_height"></div></td></tr>-->
                    <tr>
                        <td>
                            <label for="filter_unit_of_length">Единица измерения длины</label>
                            <input class="form-control form-control-sm table_filter" id="filter_unit_of_length" placeholder="Единица измерения длины">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filter_max_weight">Максимальный вес</label>
                            <input type="number" min="0" class="form-control form-control-sm table_filter" id="filter_max_weight" placeholder="Максимальный вес">
                        </td>
                    </tr>
                    <!--                    <tr><td>Максимальный вес</td></tr>-->
                    <!--                    <tr><td>-->
                    <!--                            <label for="amount-max_weight"></label>-->
                    <!--                            <input type="text" id="amount-max_weight" class="custom-slider table_filter">-->
                    <!--                        </td></tr>-->
                    <!--                    <tr><td><div id="range-max_weight"></div></td></tr>-->
                    <tr>
                        <td>
                            <label for="filter_unit_of_weight">Единица измерения веса</label>
                            <input class="form-control form-control-sm table_filter" id="filter_unit_of_weight" placeholder="Единица измерения веса">
                        </td>
                    </tr>
                    <!-- Дополнительно-->
                    <div class="filter_select">
                        <tr><td>
                                <label>Питание (Вольт)</label>
                                <input class="form-control form-control-sm table_filter" placeholder="Питание" id="filter_power">
                            </td></tr>
                        <tr><td>
                                <label>Класс защиты</label>
                                <input class="form-control form-control-sm table_filter" placeholder="Класс защиты" id="filter_protection_class">
                            </td></tr>
                    </div>
                    <div class="filter_select"> <!--Общие параметры-->
                        <tr><td><div id="filter_div_operation_principle"></div></td></tr> <!--Принцип действия-->
                        <tr><td><div id="filter_div_manufacturing_technology"></div></td></tr> <!--Технология изготовления-->
                    </div>
                    <div class="filter_select_sensor"> <!--Параметры датчиков-->
                        <tr class="filter_select_sensor"><td><label><b>Параметры датчиков</b></label></td></tr>
                        <tr class="filter_select_sensor"><td><div id="filter_div_sensitive_element"></div></td></tr> <!--Чувствительный элемент-->
                        <tr class="filter_select_sensor"><td><div id="filter_div_output_signal"></div></td></tr> <!--Характер выходного сигнала-->
                        <tr class="filter_select_sensor"><td><div id="filter_div_signal_conversation"></div></td></tr> <!--Характер преобразования сигнала-->
                    </div>
                    <!--Параметры датчиков-->
                    <div class="filter_select_sensor">
                        <tr class="filter_select_sensor"><td>
                                <label>Количество измерительных каналов</label>
                                <input class="form-control form-control-sm table_filter" placeholder="Количество каналов" id="filter_measuring_channels">
                            </td>
                        </tr>
                    </div>
                    <div class="filter_select_device"> <!--Параметры приборов-->
                        <tr class="filter_select_device"><td><label><b>Параметры приборов</b></label></td></tr>
                        <tr class="filter_select_device"><td><div id="filter_div_device_purpose"></div></td></tr> <!--Назначение-->
                        <tr class="filter_select_device"><td><div id="filter_div_control_type"></div></td></tr> <!--Способ управления-->
                        <tr class="filter_select_device"><td><div id="filter_div_measure_show_type"></div></td></tr> <!--Способ воспроизведения измеряемой величины-->
                    </div>
                    <!--Параметры приборов-->
                    <div class="filter_select_device">
                        <tr class="filter_select_device"><td>
                                <label>Выходное напряжение</label>
                                <input class="form-control form-control-sm table_filter" placeholder="Выходное напряжение" id="filter_output_voltage">
                            </td>
                        </tr>
                        <tr class="filter_select_device"><td>
                                <label>Входное сопротивление</label>
                                <input class="form-control form-control-sm table_filter" placeholder="Входное сопротивление" id="filter_in_resistance">
                            </td>
                        </tr>
                        <tr class="filter_select_device"><td>
                                <label>Выходное сопротивление</label>
                                <input class="form-control form-control-sm table_filter" placeholder="Выходное сопротивление" id="filter_out_resistance">
                            </td>
                        </tr>
                    </div>
                </table>
            </div>
        </div>

        <div class="mainTable">
            <div style="padding: 0.5em">
                <table width="100%" cellspacing="1" class="display compact" id="mainDataTable">
                    <thead>
                    <tr>
                        <th> Марка изделия </th>
                        <th> Изделие </th>
                        <th> Тип изделия </th>
                        <th> Погрешность измерения </th>
                        <th> Диапазон измерений </th>
                        <th> Ресурс </th>
                        <th> Вес </th>
                        <th title="L - длина W - ширина H - высота"> Габариты </th>
                        <th> Действие </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
<!--                    <tfoot>-->
<!--                    <tr>-->
<!--                        <th> Название </th>-->
<!--                        <th> Изделие </th>-->
<!--                        <th> Тип изделия </th>-->
<!--                        <th> Относительная погрешность </th>-->
<!--                        <th> Диапазон измерений </th>-->
<!--                        <th> Ресурс </th>-->
<!--                        <th> Вес </th>-->
<!--                        <th> Габариты </th>-->
<!--                        <th> Действие </th>-->
<!--                    </tr>-->
<!--                    </tfoot>-->
                </table>
            </div>
        </div>
        <script> // костыль, чтобы очистить поля, иначе неправильно показывается количество датчиков и приборов при возвращении на страницу
            $(".table_filter").val("")
            $('.table_filter_select option[value=0]').prop('selected', true);
            $(".table_filter_select").trigger('change.select2')
            $('#productTypeSelect option[value=0]').prop('selected', true);
            $("#productTypeSelect").trigger('change.select2')
        </script>

<!--        <div class="menu">-->
<!--            <<a href="#" class="menu-btn"><span></span></a>-->
<!--            <nav class="menu-list">-->
<!--                <a style="color: var(--theme-color)">Добавить изделие</a>-->
<!--                <a href="#sensor-0" onclick="openSideDiv('sensor', 0)"><img height="20px" src="source/file_add.png">Новый датчик</a>-->
<!--                <a href="#device-0" onclick="openSideDiv('device', 0)"><img height="20px" src="source/file_add.png">Новый прибор</a>-->
<!--                <a style="color: var(--theme-color)">Общие параметры</a>-->
<!--                <a href="#sub_data-1" onclick="openSideDiv('sub_data', 1)"><img height="20px" src="source/file.png">Производители</a>-->
<!--                <a href="#sub_data-2" onclick="openSideDiv('sub_data', 2)"><img height="20px" src="source/file.png">Литература</a>-->
<!--                <a href="#sub_data-3" onclick="openSideDiv('sub_data', 3)"><img height="20px" src="source/file.png">Среды измерения</a>-->
<!--                <a href="#sub_data-4" onclick="openSideDiv('sub_data', 4)"><img height="20px" src="source/file.png">Области применения</a>-->
<!--                <a href="#sub_data-5" onclick="openSideDiv('sub_data', 5)"><img height="20px" src="source/file.png">Технологии изготовления</a>-->
<!--                <a href="#sub_data-6" onclick="openSideDiv('sub_data', 6)"><img height="20px" src="source/file.png">Принципы действия</a>-->
<!--                <a style="color: var(--theme-color)">Параметры датчиков</a>-->
<!--                <a href="#sub_data-7" onclick="openSideDiv('sub_data', 7)"><img height="20px" src="source/file.png">Типы датчиков</a>-->
<!--                <a href="#sub_data-8" onclick="openSideDiv('sub_data', 8)"><img height="20px" src="source/file.png">Чувствительные элементы</a>-->
<!--                <a href="#sub_data-9" onclick="openSideDiv('sub_data', 9)"><img height="20px" src="source/file.png">Типы выходных сигналов</a>-->
<!--                <a href="#sub_data-10" onclick="openSideDiv('sub_data', 10)"><img height="20px" src="source/file.png">Типы преобразования сигналов</a>-->
<!--                <a style="color: var(--theme-color)">Параметры приборов</a>-->
<!--                <a href="#sub_data-11" onclick="openSideDiv('sub_data', 11)"><img height="20px" src="source/file.png">Типы приборов</a>-->
<!--                <a href="#sub_data-12" onclick="openSideDiv('sub_data', 12)"><img height="20px" src="source/file.png">Назначения</a>-->
<!--                <a href="#sub_data-13" onclick="openSideDiv('sub_data', 13)"><img height="20px" src="source/file.png">Способы управления</a>-->
<!--                <a href="#sub_data-14" onclick="openSideDiv('sub_data', 14)"><img height="20px" src="source/file.png">Воспроизведение измеряемой величины</a>-->
<!--            </nav>-->
<!--        </div>-->
<!--        <div class="side-div">-->
<!--            <a class="side-div-btn"><span></span></a>-->
<!--            <div class="side-div-content">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</main>
<?php
require_once ("footer.php");
?>