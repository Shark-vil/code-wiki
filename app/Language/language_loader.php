<?php

class Language {
    public static $langList = [
        'en-EN' => [
            'site_name' => 'Wiki-code',
            'profile' => [
                'logout' => 'Logout',
                'login' => 'Login',
                'register' => 'Register'
            ],
            'home' => [
                'title' => 'Homepage',
                'control_panel' => 'Control panel'
            ],
            'categories' => [
                'title' => 'Categories',
                'control_panel' => 'Category list',
                'add_category' => 'Add category',
                'table_library' => 'Library',
                'table_name' => 'Name',
                'table_edit' => 'Edit',
                'table_delete' => 'Delete',
                'success_delete_message' => 'Category "%name%" successfully deleted',
                'error_delete_message' => 'An error occurred while trying to delete a category',
                'edit_page_title' => 'Editing a category #',
                'any_page_form_category_name' => 'Category name',
                'any_page_form_category_name_help_text' => 'Enter category name',
                'edit_page_form_submit' => 'Update',
                'success_update_message' => 'Category "%old_name%" changed to "%name%"',
                'error_update_message' => 'An error occurred while trying to update the category',
                'create_page_title' => 'Create a category',
                'create_page_form_submit' => 'Create',
                'success_create_message' => 'Category "%name%" was successfully created',
                'error_create_message' => 'An error occurred while trying to create a category',
            ],
            'pages' => [
                'title' => 'Pages',
                'control_panel' => 'List of pages',
                'add_page' => 'Add page',
                'table_name' => 'Name',
                'table_edit' => 'Edit',
                'table_delete' => 'Delete',
                'success_delete_message' => 'Page "%library%.%name%" successfully deleted',
                'error_delete_message' => 'An error occurred while trying to delete the page',
                'edit_page_title' => 'Editing a page #',
                'any_page_form_library_name' => 'Library name',
                'any_page_form_library_name_help_text' => 'Enter the name of the library',
                'any_page_form_name' => 'Page title (Or function name)',
                'any_page_form_name_help_text' => 'Enter page title or function name',
                'any_page_form_category_name' => 'Category list',
                'any_page_form_category_name_help_text' => 'Select a category',
                'any_page_form_content_name' => 'Documentation',
                'any_page_form_preview' => 'Preview',
                'any_page_preview_content_name' => 'Preview area',
                'edit_page_form_submit' => 'Update',
                'success_update_message' => 'Page "%library%.%name%" has been successfully updated',
                'error_update_message' => 'An error occurred while trying to refresh the page',
                'create_page_title' => 'Create a page',
                'create_page_form_submit' => 'Create',
                'success_create_message' => 'Page "%library%.%name%" was successfully created',
                'error_create_message' => 'An error occurred while trying to create the page',
            ],
            'wiki' => [
                'title' => 'Wiki',
                'open_new_page_title' => 'Page - "%library%.%name%"',
                'open_new_page_state' => 'Opened documentation on the page - "%library%.%name%"',
                'error_load_page_message' => 'An error occurred while trying to get the page content'
            ],
        ],
        'ru-RU' => [
            'site_name' => 'Код-вики',
            'profile' => [
                'logout' => 'Выйти',
                'login' => 'Войти',
                'register' => 'Зарегистрироваться'
            ],
            'home' => [
                'title' => 'Домашняя страница',
                'control_panel' => 'Панель управления'
            ],
            'categories' => [
                'title' => 'Категории',
                'control_panel' => 'Список категорий',
                'add_category' => 'Добавить категорию',
                'table_library' => 'Библиотека',
                'table_name' => 'Название',
                'table_edit' => 'Редактировать',
                'table_delete' => 'Удалить',
                'success_delete_message' => 'Категория "%name%" успешно удалена',
                'error_delete_message' => 'Возникла ошибка при попытке удалить категорию',
                'edit_page_title' => 'Редактирование категории #',
                'any_page_form_category_name' => 'Название категории',
                'any_page_form_category_name_help_text' => 'Введите наименование категории',
                'edit_page_form_submit' => 'Обновить',
                'success_update_message' => 'Категория "%old_name%" изменена на "%name%"',
                'error_update_message' => 'Возникла ошибка при попытке обновить категорию',
                'create_page_title' => 'Создание категории',
                'create_page_form_submit' => 'Создать',
                'success_create_message' => 'Категория "%name%" была успешно создана',
                'error_create_message' => 'Возникла ошибка при попытке создать категорию',
            ],
            'pages' => [
                'title' => 'Страницы',
                'control_panel' => 'Список страниц',
                'add_page' => 'Добавить страницу',
                'table_name' => 'Название',
                'table_edit' => 'Редактировать',
                'table_delete' => 'Удалить',
                'success_delete_message' => 'Страница "%library%.%name%" успешно удалена',
                'error_delete_message' => 'Возникла ошибка при попытке удалить страницу',
                'edit_page_title' => 'Редактирование страницы #',
                'any_page_form_library_name' => 'Название библиотеки',
                'any_page_form_library_name_help_text' => 'Введите наименование библиотеки',
                'any_page_form_name' => 'Название страницы (Или наименование функции)',
                'any_page_form_name_help_text' => 'Введите название страницы или наименование функции',
                'any_page_form_category_name' => 'Список категорий',
                'any_page_form_category_name_help_text' => 'Выберите категорию',
                'any_page_form_content_name' => 'Документация',
                'any_page_form_preview' => 'Предпросмотр',
                'any_page_preview_content_name' => 'Область предпросмотра',
                'edit_page_form_submit' => 'Обновить',
                'success_update_message' => 'Страница "%library%.%name%" была успешно обновлена',
                'error_update_message' => 'Возникла ошибка при попытке обновить страницу',
                'create_page_title' => 'Создание страницы',
                'create_page_form_submit' => 'Создать',
                'success_create_message' => 'Страница "%library%.%name%" была успешно создана',
                'error_create_message' => 'Возникла ошибка при попытке создать страницу',
            ],
            'wiki' => [
                'title' => 'Wiki',
                'open_new_page_title' => 'Страница - "%library%.%name%"',
                'open_new_page_state' => 'Открыта документация на странице - "%library%.%name%"',
                'error_load_page_message' => 'Возникла ошибка при попытке получить контент страницы'
            ],
        ],
    ];

    public static function get($key = null) {
        $l = (!array_key_exists(env('APP_LANGUAGE'), self::$langList)) ? self::$langList['en-EN'] : self::$langList[env('APP_LANGUAGE')];
        return (is_null($key)) ? (object) $l : (object) $l[$key];
    }
}