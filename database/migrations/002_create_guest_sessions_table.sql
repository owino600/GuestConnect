CREATE TABLE IF NOT EXISTS guest_sessions (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    guest_id BIGINT UNSIGNED NOT NULL,

    session_start DATETIME NOT NULL,

    session_end DATETIME NULL,

    ip_address VARCHAR(45),

    access_point VARCHAR(100),

    ssid VARCHAR(100),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_guest_session
        FOREIGN KEY (guest_id)
        REFERENCES guests(id)
        ON DELETE CASCADE

);
