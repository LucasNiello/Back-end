# Copilot Instructions for AI Agents

## Project Overview
This codebase is a collection of PHP scripts and lessons, organized by class sessions and instructor. It is intended for educational purposes, focusing on basic PHP programming concepts and exercises.

## Directory Structure
- `01_aula/`: Contains lesson-specific PHP files (e.g., `variaveis.php`).
- `Profº Samuel/00_aula_TESTE/`: Contains additional PHP exercises (e.g., `HelloWorld.php`, `Teste02.php`).

## Key Conventions
- Each lesson or exercise is placed in its own directory, named by session or instructor.
- File names are descriptive of their content or purpose (e.g., `variaveis.php` for variable exercises).
- No framework or external dependency is used; all code is plain PHP.

## Developer Workflows
- **Run PHP files:** Use `php <filename>.php` from the appropriate directory to execute scripts.
- **No build or test automation:** There are no build scripts, test runners, or CI/CD integrations. All code is run and tested manually.

## Patterns and Practices
- Scripts are self-contained and do not rely on shared libraries or autoloaders.
- Code is organized for clarity and learning, not for production deployment.
- No database or external service integration is present.

## Examples
- To run the variable exercise: `php 01_aula/variaveis.php`
- To run a test script: `php "Profº Samuel/00_aula_TESTE/HelloWorld.php"`

## Guidance for AI Agents
- When adding new exercises, follow the existing directory and naming conventions.
- Keep each script independent unless a lesson specifically requires cross-file interaction.
- Avoid introducing frameworks or dependencies unless explicitly requested.
- Reference the `README.md` for the high-level project purpose.

