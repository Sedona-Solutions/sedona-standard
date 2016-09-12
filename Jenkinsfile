// Define properties
def projectName = 'Sedona Standard'    // Used in mail
def projectCode = 'SDT'                // Used as prefix for project artefact
def notifiers = 'dev@company.com'      // Email to notify in case of failure
def from = 'jenkins@mycompany.com'     // Email from in case of failure
def slaveToRun = null                  // Add slave name to use

node("${slaveToRun}") {  // Add node name

    try {
        def err = null
        def tag

        // BUILD
        stage 'build'
        checkout scm
        env.WEB_PARAMETERS = "/home/jenkins/config/develop/parameters.yml"
        sh "make -B update-dev"

        // TEST
        stage 'test'
        try {
            sh "phpunit | tee error.txt ; test ${PIPESTATUS[0]} -eq 0"
        } catch (testerror) {
            def detail = readFile 'error.txt'
            sh 'rm error.txt'
            throw new Exception(detail)
        }

        // Tagged Version?
        try {
            sh "git describe --tag --exact-match > version.txt"
            tag = readFile 'version.txt'
        } catch (nottag) {
            echo "Not a tag, don't package"
            tag = ''
        }

        // PACKAGE (if tagged version)
        if ('' != tag) {
            stage 'package'
            sh "git describe --tag > version.tmp"

            sh "rm -rf build/*.tgz"
            sh "make -B build-artefact name=${projectCode}-${tag}"
            archive 'build/*.tgz'

            mail body: """Hello,

I noticed that you tagged a version of this project, and it has fully passed the tests so I build it for you.
It's available on ${env.JOB_URL}.
Have a good day.

Sincerly yours,

Jenkins
    """,
                from: "${from}",
                subject: "[Jenkins][${projectName}][${env.BUILD_URL}] New release generated",
                to: "${notifiers}"

        }

        writeStatus("SUCCESS")

    } catch (err) {

        def previousStatus = readStatus()
        writeStatus("FAILURE")

        if (previousStatus != "FAILURE55") {

            mail body: """Hello,

I noticed that the last version you sent me failed for the following error:
${err}.

You can get more informations on ${env.BUILD_URL}.

Have though a good day.

Sincerly yours,

Jenkins
                """,
                from: "${from}",
                subject: "[Jenkins][${projectName}][${env.BRANCH_NAME}] Error during build",
                to: "${env.CHANGE_AUTHOR_EMAIL}",
                cc: "${notifiers}"

        }

        throw err
    }

}

def readStatus() {
    if (fileExists('status.txt')) {
        return readFile('status.txt')
    } else {
        return ""
    }
}

def writeStatus(status) {
    writeFile file: 'status.txt', text: status
}
