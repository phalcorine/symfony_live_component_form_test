## Symfony Live Form Test

### Instructions to reproduce the issue:
- Run `symfony serve` to start the web server
- Visit http://localhost:8000/live/form
- Fill in the required form data
- Click on the submit button
- You should get the following error in Symfony Profiler:
`CSRF validation failed: double-submit info was used in a previous request but is now missing`