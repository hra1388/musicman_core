<?php

return [
    'name' => 'MusicMan API',
    'version' => '5.0.0',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'url' => $_ENV['SITE_URL'] ?? 'https://mm.3rah.ir',
    'api_token' => $_ENV['API_TOKEN'] ?? '',
    'auth_secret' => $_ENV['AUTH_SECRET'] ?? '',
    'session_days' => 60,
    'admin_user_id' => 1,
    'supported_qualities' => ['320', '192', '128'],
    'default_quality' => '320',
    'telegram_bot_token' => $_ENV['TELEGRAM_BOT_TOKEN'] ?? '',
    'telegram_source_chat_id' => $_ENV['TELEGRAM_SOURCE_CHAT_ID'] ?? '-1004499922541',
    'groq_api_key' => $_ENV['GROQ_API_KEY'] ?? '',
    'google_kg_api_key' => $_ENV['GOOGLE_KG_API_KEY'] ?? '',
];
