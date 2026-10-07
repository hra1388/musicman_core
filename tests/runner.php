<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo "Running Unit Tests...\n";
(new Tests\Unit\InteractionModelTest())->testInteractionModelProperties();
echo " [OK] Unit Tests Passed.\n";

echo "Running Integration Tests...\n";
(new Tests\Integration\CatalogApiTest())->testRequestParsing();
echo " [OK] Integration Tests Passed.\n";

echo "Running Security Tests...\n";
(new Tests\Security\AuthAndSecurityTest())->testPasswordHashing();
echo " [OK] Security Tests Passed.\n";

echo "\nSUCCESS: ALL TESTS PASSED SUCCESSFULLY!\n";
