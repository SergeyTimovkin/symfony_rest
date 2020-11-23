INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Республика Мордовия'),
(2, 'Нижегородская область');

INSERT INTO `city` (`id`, `region_id`, `name`) VALUES
(1, 1, 'Саранск'),
(2, 1, 'Рузаевка'),
(3, 2, 'Арзамас '),
(4, 2, 'Нижний Новгород');


INSERT INTO `street` (`id`, `city_id`, `name`) VALUES
(1, 1, 'Девятаева'),
(2, 1, 'пр. 70 лет Октября'),
(3, 3, 'пр. 70 лет Октября'),
(4, 4, 'Карла-Маркса ');



INSERT INTO `home` (`id`, `street_id`, `number`, `lat`, `lon`) VALUES
(1, 1, 7, NULL, NULL),
(2, 2, 80, NULL, NULL);


INSERT INTO `client` (`id`, `name`) VALUES
(1, 'Сергей');


INSERT INTO `customer_addresses` (`id`, `client_id`, `home_id`, `porch`, `floor`, `intercom`, `apartment`) VALUES
(1, 1, 1, 1, 1, 1, NULL);








