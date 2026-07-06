CREATE TABLE IF NOT EXISTS guest_surveys (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    guest_id BIGINT UNSIGNED NOT NULL,

    survey_name VARCHAR(100),

    shown_at DATETIME,

    completed_at DATETIME,

    formbricks_response_id VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_guest_survey
        FOREIGN KEY (guest_id)
        REFERENCES guests(id)
        ON DELETE CASCADE

);
