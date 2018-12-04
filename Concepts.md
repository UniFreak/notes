- build stage

is a transform which converts a code repo into an executable bundle known as a build. Using a version of the code at a commit specified by the deployment process, the build stage fetches vendors dependencies and compiles binaries and assets

- release stage

takes the build produced by the build stage and combines it with the deploy’s current config. The resulting release contains both the build and the config and is ready for immediate execution in the execution environment

Every release should always have a unique release ID, 

- run stage / run time

runs the app in the execution environment, by launching some set of the app’s processes against a selected release


