# The twelve-factor app

1. Codebase: One codebase tracked in revision control, many deploys
2. Dependency: Explicitly declare and isolate dependencies
3. Config: Store config in the environment
4. Backing services: Treat backing services as attached resources
5. Build, release, run: Strictly separate build and run stages
6. Processes: Execute the app as one or more stateless processes
7. Port binding: Export services via port binding
8. Concurrency: Scale out via the process model
9. Disposability: Maximize robustness with fast startup and graceful shutdown
10. Dev/prod parity: Keep development, staging, and production as similar as possible
11. Logs: Treat logs as event streams
12. Admin processes: Run admin/management tasks as one-off processes

# Error & Logging
Error handler tools usage:

| Task you want to perform |    The best tool for the task |
|--------------------------|-------------------------------|
| Display console output for ordinary usage of a command line script or program |   `print()` |
| Report events that occur during normal operation of a program (e.g. for status monitoring or fault investigation) |  `logging.info()` (or `logging.debug()` for very detailed output for diagnostic purposes) |
| Issue a warning regarding a particular runtime event | `warnings.warn()` in library code if the issue is avoidable and the client application should be modified to eliminate the warning. `logging.warning()` if there is nothing the client application can do about the situation, but the event should still be noted |
| Report an error regarding a particular runtime event |    Raise an exception |
| Report suppression of an error without raising an exception (e.g. error handler in a long-running server process) | `logging.error()`, `logging.exception()` or `logging.critical()` as appropriate for the specific error and application domain |

Log level usage:

| Level |   When it’s used |
| ----- | ----------------- |
| DEBUG |   Detailed information, typically of interest only when diagnosing problems |
| INFO |    Confirmation that things are working as expected |
| WARNING | An indication that something unexpected happened, or indicative of some problem in the near future (e.g. ‘disk space low’). The software is still working as expected |
| ERROR |   Due to a more serious problem, the software has not been able to perform some function |
| CRITICAL |    A serious error, indicating that the program itself may be unable to continue running |

# README.md

should cover:
1. What your project does
2. How to install it
3. Example usage
4. How to set up the dev environment
5. How to ship a change
6. Change log
7. License and author info
