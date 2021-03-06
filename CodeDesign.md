# Best Practice

Abstraction principle | DRY | Once and only once | Rule of three
YAGNI
K-I-S-S principle
GRASP
    Controller
    Creator
    High Cohesion
    Indirection
    Information Expert
    Low Coupling
    Polymophism
    Protected Variations
    Pure Fabrication
SOLID
    Signle responsibility principle (SRP)   //  actors and high level architecture
        - A class should have only one reason to change. should only change when its main function
          changes and should remain unchanged when a new feature is added to it
        - Whenever you observe that a class or module starts to change for different reasons, don't hesitate,
          take the necessary steps to respect SRP. However don't overdue it because premature optimization
          can easily trick you
    Open/closed principle (OCP)             // class design and feature extensions
        - Software entities (classes, modules, functions, etc.) should be open for extension, but closed for
          modification
        - when a new functionality is needed, we should not modify our existing code but rather write
          new code that will be used by existing code
        - related design patter: Strategy design pattern; Template method design patter
    Liskov substitution principle (LSP)     // subtyping and inheritance
        - Child classes should never break the parent class' type definitions;  subclass should override the
          parent class' methods in a way that does not break functionality from a client's point of view
        - A client class should be able to use either of the subclass, if it can use these subclass's base class
        - Each object in our program must be an abstraction over a concept. If we try to map one-to-one
          real objects to programmed objects, we will almost always fail
    Interface segregation principle (ISP)   // business logic to clients communication
        - No client should be forced to depend on methods it does not use
        - Interfaces belong to their clients and not to the implementations. Thus, we should always design
          them in a way to best suite our clients. Some times we can, some times we can not exactly know
          our clients. But when we can, we should break our interfaces in many smaller ones, so they better
          satisfy the exact needs of our clients.
    Dependency inversion principle (DIP)    //
        - High-level modules should not depend on low-level modules. Both should depend on
          abstractions; Abstractions should not depend upon details. Details should depend upon
          abstractions
        - The most common, and most frequently used solution to invert the dependency is to introduce a
          more abstract module in our design

# Design Pattern

Design Principles
    Open Close Principle
    Dependency Inversion Principle
    Interface Segregation Principle
    Single Responsibility Principle
    Liskov's Substitution Principle
Creational Patterns
    Singleton
    Factory
    Factory Method
    Abstract Factory
    Builder
    Prototype
    Object Pool
Behavioral Patterns
    Chain of Responsibility
    Command
    Interpreter
    Iterator
    Mediator
    Memento
    Observer
    Strategy
    template Method
        -  is recommended to use a Template Method pattern when we have a client very specific to our
           application
    Visitor
    Null Object
Structural Patterns
    Adapter
    Bridge
    Composite
    Decorator
    Flyweight
    Prox

# Bad Practice

Code smells:
    - The Bloaters
        - Long Method
        - Large Class
        - Primitive Obsession
        - Long Parameter List
        - DataClumps
    - The Object-Orientation Abuser
        - Switch Statements
        - Temporary Fields
        - Refused Bequest
            A class that overrides a method of a base class in such a way that the contract of the base class
            is not honored by the derived class
        - Alternative Classes with Different Interfaces
    - The Change Preventor
        - Divergent Change
        - Shotgun Surgury
        - Parallel Inheritance Hierarchies
    - The Dispensables
        - Lazy Class/Freeloader
        - Data Class
        - Duplicate Code
        - Dead Code
        - Speculative Generality
    - The Couplers
        - Feature Envy
        - Inappropriate Intimacy
        - Message Chains
        - Middle Man
    - Excessively long identifiers
    - Excessively short identifiers
    - Contrived complexity
    - Cyclomatic complexity
    - Downcasting
Anti-pattern
    OOP:
    - Anemic domain model
    - BaseBean
    - Call super
    - Circle-ellipse problem
    - Circular dependency
    - Constant interface
    - God object
    - Object cesspool
    - Object orgy
    - Poltergeists
    - Sequential coupling
    - Yo-yo problem
    Programming
    - Accidental complexity
    - Action at a distance
    - Blind faith
    - Boat anchor
    - Caching failure
    - Cargo cult programming
    - Coding by exception
    - Design pattern
    - Error hiding
    - Hard code
    - Lava flow
    - Loop-switch sequence
    - Magic number
    - Magic string
    - Repeating yourself
    - Shotgun surgery
    - Soft code
    - Spaghetti code
    - Lasagna code
    Methodological
    - Copy and paste programming
    - Golden hammer
    - Improbability factor
    - Not invented here
    - Invented here
    - Premature optimization
    - Programming by permutation
    - Reinventing the square wheel
    - Silver bullet
    - Tester driven development

Mixing business logic with presentation is bad because it is against the Single Responsibility Principle.
    - Object that can 'print' themself (presentation)
    - Object that cna 'save/retrieve' themself (persistence)

Microservice
TolerantReader