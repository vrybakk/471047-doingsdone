<?php

  require_once 'functions.php';

  $show_complete_tasks = rand(0, 1);

  $categories = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

  $task_list = [
      [
          'id' => 1,
          'title' => 'Собеседование в IT компании',
          'date' => '12.02.2018',
          'category' => $categories[3],
          'status' => 'Нет'
      ],
      [
          'id' => 2,
          'title' => 'Выполнить тестовое задание',
          'date' => '25.06.2018',
          'category' => $categories[3],
          'status' => 'Нет'
      ],
      [
          'id' => 3,
          'title' => 'Сделать задание первого раздела',
          'date' => '03.02.2018',
          'category' => $categories[2],
          'status' => 'Да'
      ],
      [
          'id' => 4,
          'title' => 'Встреча с другом',
          'date' => '10.02.2018',
          'category' => $categories[1],
          'status' => 'Нет'
      ],
      [
          'id' => 5,
          'title' => 'Купить корм для кота',
          'date' => false,
          'category' => $categories[4],
          'status' => 'Нет'
      ],
      [
          'id' => 6,
          'title' => 'Заказать пиццу',
          'date' => false,
          'category' => $categories[4],
          'status' => 'Нет'
      ]
  ];

  $filtered_tasks = null;

  $page_content = include_template('templates/index.php', ['categories' => $categories, 'task_list' => $task_list, 'show_complete_tasks' => $show_complete_tasks]);

  if (isset($_GET['category_id'])) {
  	$category_id = $_GET['category_id'];

    if (!isset($categories[$category_id])) {
      http_response_code(404);
      $page_content = include_template('templates/error.php', ['error_text' => "404"]);
    } else {
      if ($categories[$category_id] != "Все") {
        $filter_category = $categories[$category_id];
        $filtered_tasks = array_filter($task_list, function($element) use ($filter_category) {
          return $element['category'] == $filter_category;
        });
        $page_content = include_template('templates/index.php', ['categories' => $categories, 'task_list' => $filtered_tasks, 'show_complete_tasks' => $show_complete_tasks]);
      }
    }
  }


  $layout_content = include_template('templates/layout.php', [
  	'content' => $page_content,
  	'categories' => $categories,
  	'title' => 'Дела в Порядке',
    'task_list' => $task_list
  ]);

  print($layout_content);

?>
