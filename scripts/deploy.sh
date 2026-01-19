#!/bin/bash

set -e

echo "🚀 Starting deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Configuration (should be set via environment variables or CI/CD)
DEPLOY_PATH="${SSH_DEPLOY_PATH:-/var/www/html}"
SSH_USER="${SSH_USER:-deploy}"
SSH_HOST="${SSH_HOST:-example.com}"

echo -e "${YELLOW}📦 Installing dependencies...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

echo -e "${YELLOW}🔍 Running code quality checks...${NC}"
composer run cs-check || echo -e "${RED}CS Fixer found issues${NC}"
composer run phpstan || echo -e "${RED}PHPStan found issues${NC}"

echo -e "${YELLOW}🧹 Clearing cache...${NC}"
php bin/console cache:clear --env=prod --no-debug

echo -e "${YELLOW}🔥 Warming up cache...${NC}"
php bin/console cache:warmup --env=prod --no-debug

echo -e "${GREEN}✅ Deployment preparation completed!${NC}"
