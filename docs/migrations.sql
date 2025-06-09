CREATE TABLE habits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid char(26) not null,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    category_id VARCHAR(50),
    resume TEXT,
    frequency VARCHAR(20), -- Ex: 'diario', 'semanal', 'mensal'
    days_of_week VARCHAR(20), -- Ex: '1,3,5' (segunda, quarta, sexta)
    hour_day TIME,
    week_goal INT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    upload_at DATETIME DEFAULT CURRENT_TIMESTAMP on update current_timestamp,
    deleted_at datetime default null,
    FOREIGN KEY (user_id) REFERENCES users(id)
);



CREATE TABLE habits_done (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid char(26) not null,
    habit_id INT NOT NULL,
    done_date DATE NOT NULL,
    is_doned BOOLEAN DEFAULT FALSE,
    note VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    upload_at DATETIME DEFAULT CURRENT_TIMESTAMP on update current_timestamp,
    deleted_at datetime default null,
    FOREIGN KEY (habit_id) REFERENCES habits(id)
);



CREATE TABLE medals (
    id INT AUTO_INCREMENT PRIMARY KEY,
	uuid char(26) not null,
    title VARCHAR(100) NOT NULL,
    resume TEXT,
    type VARCHAR(50), -- Ex: 'streak', 'total', 'constancia'
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    upload_at DATETIME DEFAULT CURRENT_TIMESTAMP on update current_timestamp,
    deleted_at datetime default null
);


CREATE TABLE medals_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    uuid char(26) not null,
    user_id INT NOT NULL,
    medal_id INT NOT NULL,
    conquered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    upload_at DATETIME DEFAULT CURRENT_TIMESTAMP on update current_timestamp,
    deleted_at datetime default null,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (medal_id) REFERENCES medals(id)
);
