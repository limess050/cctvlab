<?php defined('BASEPATH') OR exit('No direct script access allowed');

//inputs

$lang['loader_inputs_subject']                   = 'Что загружаем';
$lang['loader_inputs_how']                       = 'Загрузка';
$lang['loader_inputs_settings']                  = 'Настройка';

//settings
$lang['loader_adr_status_file']                  = 'Адрес статус-файла';
$lang['loader_update_time_interval']             = 'Интервал между обновлениями';
$lang['loader_lenses']                           = 'Объективы';

//messages

$lang['loader_messages_update_success']         = "Обновление прошло успешно";
$lang['loader_messages_update_success_not_new'] = "Обновление не требуется";
$lang['loader_messages_settings_updated']                    = "Настройки обновлены";


//Errors
$lang['loader_error_not_data']                   = "Данные по этой модели недоступны";
$lang['loader_error_no_null_loader_code']        = "Код объектива = 0 или не указан";
$lang['loader_error_not_model']                  = "Не указана модель объектива";
$lang['loader_error_not_brands']                 = "Не указан производитель объектива";
$lang['loader_error_not_points']                 = "Не найдены данные для графика";
$lang['loader_error_file_not_open']              = "Невозможно открыть xml документ";
$lang['loader_error_xml_file_incorrect']         = "XML документ некорректен";
$lang['loader_error_status-file_not_open']       = "Статус-файл недоступен";
$lang['loader_error_file_not_found']             = "Файл не найден";
$lang['loader_error_invalid_json']               = "Невалидный json";
$lang['loader_error_update_success_but_status-file']         = "Обновление прошло успешно, но результат не был записан в статус файл, повторите попытку";
