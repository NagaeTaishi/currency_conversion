# Currency Conversion App

This project provides a Dockerized development environment for Vite + Vue.js 3.

## Prerequisites
- [Docker](https://www.docker.com/) (Docker Engine + Docker Compose)
- Make sure port `5173` is available on your system.
- You need to have your own api key of Openexchangerates.org

## Getting Started
1. Clone git repository
```bash
git clone git@github.com:NagaeTaishi/currency_conversion.git
```

2. Move to the project directory
```bash
cd "to your project directory"
```

3. Register your API key of Openexchangerates.org in `frontend/.env.example`:
```bash
VITE_OPENEXCHANGE_KEY=your_api_key_here
```

4. Build the app
```bash
docker compose up --build
```

5. Access `http://localhost:5173/`
