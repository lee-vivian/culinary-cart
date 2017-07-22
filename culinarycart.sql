-- create database
DROP DATABASE IF EXISTS culinarycart;
CREATE DATABASE culinarycart;

-- use the database
USE culinarycart;

-- create the tables

-- NOTE: REMOVE drop table lines after debugging

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    username    VARCHAR(30)    NOT NULL    PRIMARY KEY,
    passkey		VARCHAR(30)    NOT NULL,
    fname	    VARCHAR(30)    NOT NULL
);

INSERT INTO `culinarycart`.`users` (`username`, `passkey`, `fname`) VALUES ('abc123', 'password', 'Tester');
INSERT INTO `culinarycart`.`users` (`username`, `passkey`, `fname`) VALUES ('bobbyflay', 'chef123', 'Bobby');
INSERT INTO `culinarycart`.`users` (`username`, `passkey`, `fname`) VALUES ('gramsay', 'hellskitchen', 'Gordon');

DROP TABLE IF EXISTS recipes;
CREATE TABLE recipes
(
    recipe_id   		 INT            PRIMARY KEY		AUTO_INCREMENT,
    recipe_name 		 VARCHAR(200)    NOT NULL,
    username		     VARCHAR(30)    NOT NULL,
    prep_time    	   	 INT			UNSIGNED,
    cook_time	 		 INT			UNSIGNED,
    cuisine		 		 VARCHAR(30),
    diet_restriction	 ENUM('vegetarian', 'vegan', 'gluten free', 'paleo',
		'kosher', 'pescetarian', 'nut allergies' , 'none'),
	recipe_type			 ENUM('drink', 'meal', 'snack'),
    num_servings		 INT			UNSIGNED,
    CONSTRAINT recipes_fk_users
		FOREIGN KEY (username)
        REFERENCES users (username)
);

INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (1, 'Home-Made Gnocchi', 'gramsay', NULL, NULL, 'italian', 'vegetarian', 'meal', 4);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (2, 'Stuffed Lamb with Spinach and Pine Nuts', 'gramsay', NULL, NULL, 'american', 'none', 'meal', 6);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (3, 'Double Chocolate Pancakes with Salted Caramel Sauce', 'bobbyflay', NULL, NULL, 'breakfast', 'none', 'meal', 4);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (4, 'Quinoa Grain Bowl with Roasted Sweet Potatoes, Chile-Marinated Tofu, Kale and Lemony Tahini-Miso', 'bobbyflay', NULL, NULL, NULL, 'vegetarian', 'meal', 4);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (5, 'Skillet Chicken Bulgogi', 'abc123', 15, 15, 'asian', 'none', 'meal', 4);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (6, 'Baked Salmon Fillets Dijon', 'abc123', 10, 15, 'american', 'pescetarian', 'meal', 4);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (7, 'Asian Pear and Strawberry Smoothie', 'abc123', 10, 0, NULL, 'none', 'snack', 2);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (8, 'Grilled Cheese', 'abc123', 5, 15, 'american', 'none', 'meal', 4);
INSERT INTO `culinarycart`.`recipes` (`recipe_id`, `recipe_name`, `username`, `prep_time`, `cook_time`, `cuisine`, `diet_restriction`, `recipe_type`, `num_servings`) VALUES (9, 'Cold Water', 'abc123', 1, 0, NULL, 'none', 'drink', 4);


DROP TABLE IF EXISTS steps;
CREATE TABLE steps
(
    recipe_id	INT,
    step_num	INT		UNSIGNED,
    description VARCHAR(10000),
    CONSTRAINT recipe_and_step_pk
		PRIMARY KEY(recipe_id, step_num),
	CONSTRAINT steps_fk_recipes
		FOREIGN KEY (recipe_id)
        REFERENCES recipes (recipe_id)
        ON DELETE CASCADE
);

INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (1, 1, 'Preheat the oven to 200 degrees C/Gas 6.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (1, 2, 'Bake the potatoes in their skins for 1 - 1.25 hours until tender the whole way through. Remove the flesh from the skins (ideally while still warm) and mash until smooth - a potato ricer works best here. Mix in the ricotta, a pinch of salt and white pepper and the flour. Make a well in the middle, add the beaten egg and begin to combine the mixture with floured hands. Work in the thyme leaves and continue until a smooth dough has formed. (Be careful not to overwork it or the dough will end up too dense and will not expand when it goes into the water.)');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (1, 3, 'Cut the dough in half and shape each piece into a long cigar shape about 1.5cm thick. Using the back of a floured table knife, cut each length of dough into 2cm pieces to make pillows or individual gnocchi. Gently press each one in the centre using your floured finger. The dent will hold more sauce and allow the gnocchi to take on more flavour.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (1, 4, 'Bring a large pan of water to the boil. Add the gnocchi, tilting the pan from side to side briefly to stop them sticking together, then simmer for about 1.5-2 minutes until they start to float. Drain the gnocchi and leave them to steam-dry for 1-2 minutes.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (1, 5, 'Meanwhile, start to make the sauce. Heat a frying pan over a medium-high heat and add a little olive oil. Add the gnocchi to the hot pan with a pinch of salt and black pepper and saute for 1-2 minutes on each side until nicely coloured.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (1, 6, 'Add the peas to the pan with a knob of butter and the thyme leaves. Toss to heat through, then add the lemon zest. Serve with grated Parmesan cheese.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 1, 'Saute the onion and garlic in a medium-hot pan with a dash of olive oil for 5 minutes until softened. Season, then add the pine nuts and fry for about 1 minute until golden. Add the spinach and wilt briefly in the pan, tossing to mix well. Remove from the heat and stir in the feta.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 2, 'Lay the saddle of lamb open on a board, flesh side up. Season with salt and pepper and sprinkle over the sumac. Spoon the spinach mixture along the middle of the meat, using the fillets that run down the inside length of the meat to support the sides of the stuffing.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 3, 'Roll the meat around the filling and tie at intervals with string. Season the outside of the lamb all over, then chill for at least 30 minutes or overnight to help firm it up and make it easier to brown.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 4, 'Preheat the oven to 190 degrees C/Gas 5.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 5, 'Put a roasting tray on the hob and heat until hot. Add a glug of oil and fry the joint for 10 minutes until brown all over. Transfer to the preheated oven and cook for 45-55 minutes, depending on the weight of the lamb and how pink you like it. When cooked, set aside to rest.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 6, 'Meanwhile, mix all the dressing ingredients together and add a little seasoning.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (2, 7, 'Serve the rested lamb hot or at room temperature, thickly sliced, with the dressing on the side.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (5, 1, 'Whisk onion, soy sauce, brown sugar, garlic, sesame oil, sesame seeds, cayenne pepper, salt, and black pepper together in a bowl until marinade is smooth.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (5, 2, 'Cook and stir chicken and marinade together in a large skillet over medium-high heat until chicken is cooked through, about 15 minutes.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (6, 1, 'Preheat oven to 400 degrees F (200 degrees C). Line a shallow baking pan with aluminum foil.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (6, 2, 'Place salmon skin-side down on foil. Spread a thin layer of mustard on the top of each fillet, and season with salt and pepper. Top with bread crumbs, then drizzle with melted butter.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (6, 3, 'Bake in a preheated oven for 15 minutes, or until salmon flakes easily with a fork.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (7, 1, 'Place the ice, Asian pear, strawberries, yogurt, milk, and sugar into a blender; blend until smooth.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (8, 1, 'Preheat skillet over medium heat.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (8, 2, 'Generously butter one side of a slice of bread. Place bread butter-side-down onto skillet bottom and add 1 slice of cheese.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (8, 3, 'Butter a second slice of bread on one side and place butter-side-up on top of sandwich. Grill until lightly browned and flip over; continue grilling until cheese is melted.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (8, 4, 'Repeat with remaining 2 slices of bread, butter and slice of cheese.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (9, 1, 'Take water from fridge.');
INSERT INTO `culinarycart`.`steps` (`recipe_id`, `step_num`, `description`) VALUES (9, 2, 'Pour water into four glasses.');


DROP TABLE IF EXISTS ingredients;
CREATE TABLE ingredients
(
    ingredient_name    VARCHAR(50),
    quantity		   DECIMAL(10,2),
    unit_type		   ENUM('count', 'weight', 'volume'),
    weight_unit		   ENUM('lb', 'oz', 'g', 'kg', 'null'),
    volume_unit		   ENUM('tsp', 'tbsp', 'cup', 'pint', 'qt', 'gal', 'fl oz', 'l', 
        'cubic in', 'null'),
	recipe_id		   INT		NOT NULL,
    CONSTRAINT name_and_recipe_pk
		PRIMARY KEY(ingredient_name, recipe_id),
    CONSTRAINT ingredients_fk_recipes
		FOREIGN KEY (recipe_id)
        REFERENCES recipes (recipe_id)
        ON DELETE CASCADE
);

INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('onion', 0.25, 'volume', 'null', 'cup', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('soy sauce', 5.00, 'volume', 'null', 'tbsp', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('brown sugar', 2.50, 'volume', 'null', 'tbsp', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('minced garlic', 2.00, 'volume', 'null', 'tbsp', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('sesame oil', 2.00, 'volume', 'null', 'tbsp', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('sesame seeds', 1.00, 'volume', 'null', 'tbsp', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('cayenne', 0.50, 'volume', 'null', 'tsp', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('ground black pepper', 4.00, 'weight', 'g', 'null', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('chicken breasts', 1.00, 'weight', 'lb', 'null', 5);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('salmon', 16.00, 'weight', 'oz', 'null', 6);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('dijon mustard', 3.00, 'volume', 'null', 'tbsp', 6);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('salt', 2.50, 'weight', 'g', 'null', 6);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('ground black pepper', 4.00, 'weight', 'g', 'null', 6);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('italian-style dry bread crumbs', 0.25, 'volume', 'null', 'cup', 6);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('butter', 0.25, 'volume', 'null', 'cup', 6);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('ice', 0.50, 'volume', 'null', 'cup', 7);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('asian pears', 1.00, 'count', 'null', 'null', 7);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('strawberries', 2.00, 'count', 'null', 'null', 7);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('vanilla fat-free yogurt', 0.67, 'volume', 'null', 'cup', 7);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('fat-free milk', 0.25, 'volume', 'null', 'cup', 7);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('white sugar', 2.00, 'volume', 'null', 'tsp', 7);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('bread (sliced)', 4.00, 'count', 'null', 'null', 8);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('butter', 3.00, 'volume', 'null', 'tbsp', 8);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('cheddar cheese (sliced)', 2.00, 'count', 'null', 'null', 8);
INSERT INTO `culinarycart`.`ingredients` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `recipe_id`) VALUES ('cold water', 8, 'volume', 'null', 'cup', 9);


DROP TABLE IF EXISTS pantry;
CREATE TABLE pantry
(
	ingredient_name	   VARCHAR(50)		PRIMARY KEY,
	quantity		   DECIMAL(10,2),
    unit_type		   ENUM('count', 'weight', 'volume'),
    weight_unit		   ENUM('lb', 'oz', 'g', 'kg', 'null'),
    volume_unit		   ENUM('tsp', 'tbsp', 'cup', 'pint', 'qt', 'gal', 'fl oz', 
        'cubic in', 'null'),
	username		   VARCHAR(30)		NOT NULL,
	CONSTRAINT pantry_fk_users
		FOREIGN KEY (username)
		REFERENCES users (username)
);

INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('brown sugar', 2.00, 'volume', 'null', 'tbsp', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('ground black pepper', 219.00, 'weight', 'g', 'null', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('dijon mustard', 3.00, 'volume', 'null', 'tbsp', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('salmon', 4.00, 'weight', 'oz', 'null', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('fat-free milk', 1.00, 'volume', 'null', 'gal', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('butter', 0.50, 'volume', 'null', 'cup', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('cheddar cheese (sliced)', 10.00, 'count', 'null', 'null', 'abc123');
INSERT INTO `culinarycart`.`pantry` (`ingredient_name`, `quantity`, `unit_type`, `weight_unit`, `volume_unit`, `username`) VALUES ('bread (sliced)', 12.00, 'count', 'null', 'null', 'abc123');

DROP TABLE IF EXISTS meal_plan;
CREATE TABLE meal_plan
(
    meal_plan_id	INT    		PRIMARY KEY	AUTO_INCREMENT,
    recipe_id	INT    			NOT NULL,
    recipe_name VARCHAR(60) 	NOT NULL,
    which_day	ENUM('Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'),
    username	VARCHAR(30) 	NOT NULL,
    CONSTRAINT meal_plan_fk_recipes
		FOREIGN KEY (recipe_id)
        REFERENCES recipes (recipe_id)
        ON DELETE CASCADE
);

INSERT INTO `culinarycart`.`meal_plan` (`meal_plan_id`, `recipe_id`, `recipe_name`, `which_day`, `username`) VALUES (1, 7, 'Asian Pear and Strawberry Smoothie', 'Sun', 'abc123');
INSERT INTO `culinarycart`.`meal_plan` (`meal_plan_id`, `recipe_id`, `recipe_name`, `which_day`, `username`) VALUES (2, 5, 'Skillet Chicken Bulgogi', 'Mon', 'abc123');
INSERT INTO `culinarycart`.`meal_plan` (`meal_plan_id`, `recipe_id`, `recipe_name`, `which_day`, `username`) VALUES (3, 6, 'Baked Salmon Fillets Dijon', 'Wed', 'abc123');
INSERT INTO `culinarycart`.`meal_plan` (`meal_plan_id`, `recipe_id`, `recipe_name`, `which_day`, `username`) VALUES (4, 8, 'Grilled Cheese', 'Fri', 'abc123');
INSERT INTO `culinarycart`.`meal_plan` (`meal_plan_id`, `recipe_id`, `recipe_name`, `which_day`, `username`) VALUES (5, 8, 'Grilled Cheese', 'Sat', 'abc123');

DROP TABLE IF EXISTS favorites;
CREATE TABLE favorites
(
    username	VARCHAR(30),
    recipe_id	INT,
    recipe_name VARCHAR(30),
    CONSTRAINT username_recipe_pk
		PRIMARY KEY(username, recipe_id),
	CONSTRAINT favorites_fk_users
		FOREIGN KEY (username)
        REFERENCES users (username),
	CONSTRAINT favorites_fk_recipes
		FOREIGN KEY (recipe_id)
        REFERENCES recipes (recipe_id)
        ON DELETE CASCADE
);

DROP TABLE IF EXISTS history;
CREATE TABLE history
(
    log_id        INT            PRIMARY KEY    AUTO_INCREMENT,
    username      VARCHAR(30)    NOT NULL,
    date_created  DATE,
    recipe_id     INT            NOT NULL,
    recipe_name	  VARCHAR(200)	 NOT NULL,
    CONSTRAINT history_fk_users
		FOREIGN KEY (username)
        REFERENCES users (username),
    CONSTRAINT history_fk_recipes_id
		FOREIGN KEY	(recipe_id)
        REFERENCES recipes (recipe_id)
);

DROP PROCEDURE IF EXISTS search_by_time;
DELIMITER //
CREATE PROCEDURE search_by_time
	(IN username_param VARCHAR(30),
     IN time_param	   INT)
    BEGIN
		SELECT recipe_id, recipe_name, prep_time, cook_time, prep_time + cook_time AS total_time, 
			cuisine, diet_restriction, recipe_type, num_servings 
		FROM recipes
        WHERE username = username_param AND prep_time + cook_time <= time_param
        ORDER BY total_time;
    END //
DELIMITER ;

-- Tests search_by_time procedure
CALL search_by_time('abc123', 30);
CALL search_by_time('gramsay', 45);
CALL search_by_time('abc123', 10);
CALL search_by_time('abc123', 5);

DROP PROCEDURE IF EXISTS search_by_cuisine;
DELIMITER //
CREATE PROCEDURE search_by_cuisine
	(IN username_param VARCHAR(30),
     IN cuisine_param  VARCHAR(30))
	BEGIN
		SELECT recipe_id, recipe_name, prep_time, cook_time, prep_time + cook_time AS total_time, 
			cuisine, diet_restriction, recipe_type, num_servings 
		FROM recipes
        WHERE username = username_param AND cuisine = cuisine_param;
	END //
DELIMITER ;

-- Tests search_by_cuisine procedure
CALL search_by_cuisine('gramsay', 'american');
CALL search_by_cuisine('bobbyflay', 'breakfast');
CALL search_by_cuisine('abc123', 'american');
CALL search_by_cuisine('abc123', 'asian');

DROP PROCEDURE IF EXISTS search_by_diet;
DELIMITER //
CREATE PROCEDURE search_by_diet
	(IN username_param VARCHAR(30),
     IN diet_param     VARCHAR(30))
	BEGIN
		SELECT recipe_id, recipe_name, prep_time, cook_time, prep_time + cook_time AS total_time, 
			cuisine, diet_restriction, recipe_type, num_servings 
		FROM recipes
        WHERE username = username_param AND diet_restriction = diet_param;
	END //
DELIMITER ;

-- Tests search_by_diet procedure
CALL search_by_diet('gramsay', 'vegetarian');
CALL search_by_diet('bobbyflay', 'none');
CALL search_by_diet('abc123', 'none');
CALL search_by_diet('abc123', 'pescetarian');

DROP PROCEDURE IF EXISTS search_by_type;
DELIMITER //
CREATE PROCEDURE search_by_type
	(IN username_param VARCHAR(30),
     IN type_param     VARCHAR(30))
	BEGIN
		SELECT recipe_id, recipe_name, prep_time, cook_time, prep_time + cook_time AS total_time, 
			cuisine, diet_restriction, recipe_type, num_servings 
		FROM recipes
        WHERE username = username_param AND recipe_type = type_param;
	END //
DELIMITER ;

-- Tests search_by_type procedure
CALL search_by_type('abc123', 'drink');
CALL search_by_type('abc123', 'meal');
CALL search_by_type('abc123', 'snack');

DROP PROCEDURE IF EXISTS search_by_servings;
DELIMITER //
CREATE PROCEDURE search_by_servings
	(IN username_param VARCHAR(30),
     IN servings_param INT)
	BEGIN 
		SELECT recipe_id, recipe_name, prep_time, cook_time, prep_time + cook_time AS total_time, 
			cuisine, diet_restriction, recipe_type, num_servings 
		FROM recipes
        WHERE username = username_param AND num_servings >= servings_param
        ORDER BY num_servings DESC;
	END //
DELIMITER ;

-- Tests search_by_servings
CALL search_by_servings('gramsay', 4);
CALL search_by_servings('bobbyflay', 2);
CALL search_by_servings('bobbyflay', 8);
CALL search_by_servings('abc123', 1);
CALL search_by_servings('abc123', 3);


-- Converts between measurements (count, weight, volume)

DROP FUNCTION IF EXISTS measurement_converter;
DELIMITER //
CREATE FUNCTION measurement_converter
(
	unit_type_param	ENUM ('count', 'weight', 'volume'),
    quantity_param	DECIMAL(10, 2),
    weight_unit_before_param ENUM('lb', 'oz', 'g', 'kg', 'null'),
    weight_unit_after_param ENUM('lb', 'oz', 'g', 'kg', 'null'),
    volume_unit_before_param ENUM('tsp', 'tbsp', 'cup', 'pint', 'qt', 'gal', 'fl oz', 'l', 'cubic in', 'null'),
    volume_unit_after_param ENUM('tsp', 'tbsp', 'cup', 'pint', 'qt', 'gal', 'fl oz', 'l', 'cubic in', 'null')
)
RETURNS DECIMAL(10, 2)

BEGIN
	DECLARE rv DECIMAL(10, 2);
    
    IF unit_type_param = 'count' THEN SET rv = quantity_param;
    
    ELSEIF unit_type_param = 'weight' THEN
    
		IF weight_unit_before_param = 'lb' THEN
			IF weight_unit_after_param = 'lb' THEN SET rv = quantity_param;
			ELSEIF weight_unit_after_param = 'oz' THEN SET rv = 16.00 * quantity_param;
			ELSEIF weight_unit_after_param = 'g' THEN SET rv = 453.592 * quantity_param;
			ELSEIF weight_unit_after_param = 'kg' THEN SET rv = 0.453592 * quantity_param;
			END IF;
    
		ELSEIF weight_unit_before_param = 'oz' THEN
			IF weight_unit_after_param = 'lb' THEN SET rv = quantity_param / 16.00;
			ELSEIF weight_unit_after_param = 'oz' THEN SET rv = quantity_param;
			ELSEIF weight_unit_after_param = 'g' THEN SET rv = 28.3495 * quantity_param;
			ELSEIF weight_unit_after_param = 'kg' THEN SET rv = 0.0283495 * quantity_param;
			END IF;
    
		ELSEIF weight_unit_before_param = 'g' THEN
			IF weight_unit_after_param = 'lb' THEN SET rv = quantity_param / 453.592;
			ELSEIF weight_unit_after_param = 'oz' THEN SET rv = quantity_param / 28.3495;
			ELSEIF weight_unit_after_param = 'g' THEN SET rv = quantity_param;
			ELSEIF weight_unit_after_param = 'kg' THEN SET rv = quantity_param / 1000;
			END IF;
    
		ELSEIF weight_unit_before_param = 'kg' THEN
			IF weight_unit_after_param = 'lb' THEN SET rv = quantity_param / 0.453592;
			ELSEIF weight_unit_after_param = 'oz' THEN SET rv = quantity_param / 0.0283495;
			ELSEIF weight_unit_after_param = 'g' THEN SET rv = quantity_param * 1000;
			ELSEIF weight_unit_after_param = 'kg' THEN SET rv = quantity_param;
			END IF;
		END IF;
        
	ELSEIF unit_type_param = 'volume' THEN
    
		IF volume_unit_before_param = 'tsp' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param / 3.00;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param / 48.00;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param / 96.00;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param / 192.00;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 768.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param / 6.00;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param / 202.884;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param / 3.32468;
			END IF;

		ELSEIF volume_unit_before_param = 'tbsp' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 3.00;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param / 16.00;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param / 32.00;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param / 64.00;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 256.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param / 2.00;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param / 67.628;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param / 1.10823;
			END IF;
        
		ELSEIF volume_unit_before_param =  'cup' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 48.00;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 16.00;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param / 2.00;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param / 4.00;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 16.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param * 8.00;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param / 4.22675;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param * 14.4375;
			END IF;
        
		ELSEIF volume_unit_before_param = 'pint' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 96.00;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 32.00;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param * 2.00;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param / 2.00;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 8.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param * 16.00;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param * 0.473176;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param * 28.875;
			END IF;
	
		ELSEIF volume_unit_before_param = 'qt' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 192.00;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 64.00;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param * 4.00;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param * 2.00;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 4.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param * 32.00;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param / 1.05669;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param * 57.75;
			END IF;
		
		ELSEIF volume_unit_before_param = 'gal' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 768.00;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 256.00;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param * 16.00;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param * 8.00;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param * 4.00;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param * 128.00;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param * 3.78541;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param * 231.00;
			END IF;
		
		ELSEIF volume_unit_before_param = 'fl oz' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 6.00;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 2.00;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param / 8.00;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param / 16.00;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param / 32.00;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 128.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param / 33.814;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param / 0.554113;
			END IF;
    
		ELSEIF volume_unit_before_param = 'l' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 202.884;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 67.628;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param * 4.22675;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param / 0.473176;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param * 1.05669;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 3.78541;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param * 33.814;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param * 61.0237;
			END IF;
		
		ELSEIF volume_unit_before_param = 'cubic in' THEN
			IF volume_unit_after_param = 'tsp' THEN SET rv = quantity_param * 3.32468;
			ELSEIF volume_unit_after_param = 'tbsp' THEN SET rv = quantity_param * 1.10823;
			ELSEIF volume_unit_after_param = 'cup' THEN SET rv = quantity_param / 14.4375;
			ELSEIF volume_unit_after_param = 'pint' THEN SET rv = quantity_param / 28.875;
			ELSEIF volume_unit_after_param = 'qt' THEN SET rv = quantity_param / 57.75;
			ELSEIF volume_unit_after_param = 'gal' THEN SET rv = quantity_param / 231.00;
			ELSEIF volume_unit_after_param = 'fl oz' THEN SET rv = quantity_param * 0.554113;
			ELSEIF volume_unit_after_param = 'l' THEN SET rv = quantity_param / 61.0237;
			ELSEIF volume_unit_after_param = 'cubic in' THEN SET rv = quantity_param;
			END IF;
		END IF;
	END IF;
    
    RETURN rv;
    
END//

DELIMITER ;
    
-- Tests measurement converter function

SELECT '5.00 count' AS 'before', CONCAT(measurement_converter('count', 5.00, 'null', 'null', 'null', 'null'), ' count') AS 'after';

SELECT '16 g' AS 'before', CONCAT(measurement_converter('weight', 16, 'g', 'oz', 'null', 'null'), ' oz') AS 'after';
SELECT '15 lb' AS 'before', CONCAT(measurement_converter('weight', 15, 'lb', 'kg', 'null', 'null'), ' kg') AS 'after';
SELECT '1900 oz' AS 'before', CONCAT(measurement_converter('weight', 1900, 'oz', 'kg', 'null', 'null'), ' kg') AS 'after';
SELECT '10 kg' AS 'before', CONCAT(measurement_converter('weight', 10, 'kg', 'lb', 'null', 'null'), ' lb') AS 'after';

SELECT '2 tsp' AS 'before', CONCAT(measurement_converter('volume', 2, 'null', 'null', 'tsp', 'tbsp'), ' tbsp') AS 'after';
SELECT '100 tbsp' AS 'before', CONCAT(measurement_converter('volume', 100, 'null', 'null', 'tbsp', 'pint'), ' pint') AS 'after';
SELECT '5 cup' AS 'before', CONCAT(measurement_converter('volume', 5, 'null', 'null', 'cup', 'qt'), ' qt') AS 'after';
SELECT '4 pint' AS 'before', CONCAT(measurement_converter('volume', 5, 'null', 'null', 'pint', 'gal'), ' gal') AS 'after';
SELECT '0 qt' AS 'before', CONCAT(measurement_converter('volume', 0, 'null', 'null', 'qt', 'fl oz'), ' fl oz') AS 'after';
SELECT '6 gal' AS 'before', CONCAT(measurement_converter('volume', 6, 'null', 'null', 'gal', 'l'), ' l') AS 'after';
SELECT '17 fl oz' AS 'before', CONCAT(measurement_converter('volume', 17, 'null', 'null', 'fl oz', 'qt'), ' qt') AS 'after';
SELECT '50 l' AS 'before', CONCAT(measurement_converter('volume', 50, 'null', 'null', 'l', 'cubic in'), ' cubic in') AS 'after';
SELECT '480 cubic in' AS 'before', CONCAT(measurement_converter('volume', 480, 'null', 'null', 'cubic in', 'pint'), ' pint') AS 'after';
    
    
-- Returns list of missing ingredients (from pantry) given recipe_id
-- Assumes that given recipe_id is valid

DROP PROCEDURE IF EXISTS missing_ingredients;
DELIMITER //
CREATE PROCEDURE missing_ingredients
	(IN recipe_id_param		INT)
    BEGIN
		-- In stock but not enough
			SELECT i.ingredient_name, 
					i.quantity - measurement_converter(p.unit_type, p.quantity, p.weight_unit, i.weight_unit, p.volume_unit, i.volume_unit) AS 'quantity',
					IF(i.unit_type = 'weight', i.weight_unit, IF(i.unit_type = 'volume', i.volume_unit, 'count')) AS 'unit'
				FROM ingredients i CROSS JOIN pantry p
				WHERE i.recipe_id = recipe_id_param 
					AND i.ingredient_name = p.ingredient_name
					AND i.unit_type = p.unit_type
					AND measurement_converter(p.unit_type, p.quantity, p.weight_unit, i.weight_unit, p.volume_unit, i.volume_unit) < i.quantity
		UNION
		-- Not in stock
			SELECT i.ingredient_name, i.quantity, IF(i.unit_type = 'weight', i.weight_unit, IF(i.unit_type = 'volume', i.volume_unit, 'count')) AS 'unit'
				FROM ingredients i
				WHERE i.recipe_id = recipe_id_param
					AND i.ingredient_name NOT IN (SELECT p.ingredient_name FROM pantry p);
    END //

DELIMITER ;

-- Tests missing_ingredients procedure

CALL missing_ingredients(5);
CALL missing_ingredients(6);
CALL missing_ingredients(7);
CALL missing_ingredients(8);
CALL missing_ingredients(100);

-- Deletes the record from the meal plan table corresponding to the given meal plan id
DROP PROCEDURE IF EXISTS mark_completed;
DELIMITER //
CREATE PROCEDURE mark_completed
	(IN meal_plan_id_param	INT,
	 IN recipe_id_param		INT)
    
    BEGIN
		DELETE FROM meal_plan
        WHERE meal_plan_id = meal_plan_id_param;
	END //
DELIMITER ;

-- Inserts the completed meal into the history table log
DROP TRIGGER IF EXISTS history_after_delete;
DELIMITER //
CREATE TRIGGER history_after_delete
	AFTER DELETE ON meal_plan
    FOR EACH ROW
    
    BEGIN
        INSERT INTO history VALUES
        (0, OLD.username, CURDATE(), OLD.recipe_id, OLD.recipe_name);
    END //
    
DELIMITER ;

-- Deletes items from pantry after meal is made and added to history log
DROP TRIGGER IF EXISTS deplete_pantry;
DELIMITER //
CREATE TRIGGER deplete_pantry
	AFTER INSERT ON history
    FOR EACH ROW
    
    BEGIN
    
		DECLARE ingredient_name_var	VARCHAR(50);
        DECLARE quantity_var	DECIMAL(10, 2);
        DECLARE unit_type_var	ENUM('count', 'weight', 'volume');
        DECLARE weight_unit_var	ENUM('lb', 'oz', 'g', 'kg', 'null');
        DECLARE volume_unit_var ENUM('tsp', 'tbsp', 'cup', 'pint', 'qt', 'gal', 'fl oz', 'l', 'cubic in', 'null');
        DECLARE row_not_found	TINYINT		DEFAULT		FALSE;
        
        DECLARE ingredients_cursor CURSOR FOR
			SELECT ingredient_name, quantity, unit_type, weight_unit, volume_unit
			FROM ingredients
			WHERE recipe_id = NEW.recipe_id
            ORDER BY ingredient_name;
            
		DECLARE CONTINUE HANDLER FOR NOT FOUND
			SET row_not_found = TRUE;
            
		OPEN ingredients_cursor;
        
        WHILE row_not_found = FALSE DO
			FETCH ingredients_cursor INTO ingredient_name_var, quantity_var, unit_type_var, weight_unit_var, volume_unit_var;
            
            UPDATE pantry
			SET pantry.quantity =
				pantry.quantity - measurement_converter(pantry.unit_type, quantity_var, weight_unit_var,
					pantry.weight_unit, volume_unit_var, pantry.volume_unit)
			WHERE pantry.ingredient_name = ingredient_name_var;
		END WHILE;
        
        -- Adds back last ingredient that was double counted (while loop)
        UPDATE pantry
        SET pantry.quantity = pantry.quantity + measurement_converter(pantry.unit_type, quantity_var, weight_unit_var,
					pantry.weight_unit, volume_unit_var, pantry.volume_unit)
		WHERE pantry.ingredient_name = ingredient_name_var;
        
        CLOSE ingredients_cursor;
    END //
DELIMITER ;

SET SQL_SAFE_UPDATES = 0;