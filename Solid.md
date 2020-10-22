Encapsulation
    information hiding(misleading) => implementation hiding
    protection of invariants
        pre-condition checking
            constructor initiation
            guard clause(fail fast with Exception)
        post-condition checking
            guard clause
            tester/doer --> not thread safe
            tryDo --> not very OO
            maybe

    Command Query Separation(CQS): operation should be either command or query but not both
        command:
            has side effects, mutate state
            can invoke queries
        query:
            do NOT mutate observable state
            idempotent
            safe to invoke
    Postel's laws(robustness principle)
        be conservative in what you send
        be liberal in what you accept
        the stronger gurantee of your method provide, the easier to use
    Input:



?
    nullable reference