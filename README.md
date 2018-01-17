GrantThornton 
===============================

Grant Thornton is one of the world's leading organisations of independent assurance, tax and advisory firms.

Grant Thornton CJSC, the Armenian member of Grant Thornton International, is a multi-professional group of public accountants and auditors, specialist advisers in finance, business and management, as well as tax and legal advisers.  
Grant Thornton was founded in early 1990s by Grant Thornton (France), organized by a common professional vision and especially focused on providing high quality services to its clients. 
Grant Thornton Armenia is the leading audit and advisory services firm in the market, sharing the Grant Thornton philosophy worldwide. The firm provides partner-led, personalised services with high end professional standards and approaches dedicated to the needs of dynamic, growth orientated organizations of public and private sectors.
DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
