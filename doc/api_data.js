define({ "api": [
  {
    "type": "post",
    "url": "HOST/api/login",
    "title": "User login",
    "version": "1.0.0",
    "name": "login",
    "description": "<p>Generates token for user</p>",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username/student ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Hashed password (WIP)</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>The auth token</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "Bearer"
            ],
            "optional": false,
            "field": "token_type",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "expires_in",
            "description": "<p>Token lifespan</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "{\n    \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90YWxpbmEubG9jYWw6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU4OTE5OTE4NSwiZXhwIjoxNTg5MjAyNzg1LCJuYmYiOjE1ODkxOTkxODUsImp0aSI6ImN2TVhWakdhNjRTT0x3NmkiLCJzdWIiOiJKREpWSkdELTdhbjZlbDUiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3Iiwia2V5Ijo4fQ.V_9sTyiSHk5VuaIm6uy3cGzigvqDRBoL4Ek7SjR49Vg\",\n    \"token_type\": \"Bearer\",\n    \"expires_in\": 3600\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "HOST/api/classes",
    "title": "Get list of classes",
    "version": "1.0.0",
    "name": "ClassList",
    "description": "<p>Retrieves a list of classes</p>",
    "group": "Classes",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "StringOrNumber",
            "optional": false,
            "field": "user_id",
            "description": "<p>ID of user. If user is logged in, use <code>user_id=me</code></p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "allowedValues": [
              "schedules",
              "students"
            ],
            "optional": false,
            "field": "include",
            "description": "<p>Comma separated relations to include. By default, lists don't include relations</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Unique class id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Defined class name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Class description</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "frequency",
            "description": "<p>The frequency of session</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_from",
            "description": "<p>Start of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "date_to",
            "description": "<p>End of class</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_from",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Time",
            "optional": false,
            "field": "time_to",
            "description": "<p>Class duration</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "teacher",
            "description": "<p>The teacher handling the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "teacher.id",
            "description": "<p>Unique teacher id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "teacher.name",
            "description": "<p>The teacher's name</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "schedules",
            "description": "<p>The class schedules</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.id",
            "description": "<p>Unique schedule id</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.date",
            "description": "<p>Session date</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.status",
            "description": "<p>Session status: done, canceled</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "schedules.materials",
            "description": "<p>Class resources: notes, lessons, etc</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.materials.id",
            "description": "<p>Unique material id</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.materials.title",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.materials.instruction",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.materials.description",
            "description": ""
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.materials.uploaded_file",
            "description": "<p>If there's any uploaded file e.g. pdf, word, excel, ppt</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.materials.resource_link",
            "description": "<p>Link to materials e.g google doc, website,etc</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "schedules.materials.added_by",
            "description": "<p>Someone who added the material</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "schedules.materials.added_by.id",
            "description": "<p>ID of uploader</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "schedules.materials.added_by.name",
            "description": "<p>Name of uploader</p>"
          },
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "students",
            "description": "<p>List of students enrolled in the class</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.id",
            "description": "<p>ID of student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.name",
            "description": "<p>Name of student</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "students.user_type",
            "description": "<p>'s' =&gt; student by  default</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Sample Response",
          "content": "[\n    {\n       \"id\": 1,\n       \"name\": \"English 101\",\n       \"description\": \"learn basics\",\n       \"frequency\": \"M,W,F\",\n       \"date_from\": \"2020-05-11\",\n       \"date_to\": \"2020-05-15\",\n       \"time_from\": \"09:00:00\",\n       \"time_to\": \"10:00:00\",\n       \"teacher\": {\n           \"id\": 8,\n           \"name\": \"teacher tom\"\n       },\n       \"schedules\": [\n           {\n               \"id\": 1,\n               \"date\": \"2020-05-11\",\n               \"status\": 0,\n               \"materials\": [\n                   {\n                       \"id\": 1,\n                       \"title\": \"English Writing Part 1\",\n                       \"instruction\": \"read the textbook\",\n                       \"description\": \"learn english writing\",\n                       \"uploaded_file\": null,\n                       \"resource_link\": \"https://sample-lesson-link.com/english-writing-part1\",\n                       \"added_by\": {\n                           \"id\": 8,\n                           \"name\": \"teacher tom\"\n                       }\n                   },\n                   {\n                       \"id\": 2,\n                       \"title\": \"English Writing Part 1\",\n                       \"instruction\": \"read the textbook\",\n                       \"description\": \"learn english writing\",\n                       \"uploaded_file\": null,\n                       \"resource_link\": \"https://sample-lesson-link.com/english-writing-part2\",\n                       \"added_by\": {\n                           \"id\": 8,\n                           \"name\": \"teacher tom\"\n                       }\n                   }\n               ]\n           },\n           {\n               \"id\": 2,\n               \"date\": \"2020-05-13\",\n               \"status\": 0,\n               \"materials\": [\n                   {\n                       \"id\": 3,\n                       \"title\": \"English Speaking\",\n                       \"instruction\": \"read the textbook\",\n                       \"description\": \"learn english speaking\",\n                       \"uploaded_file\": null,\n                       \"resource_link\": \"https://sample-lesson-link.com/english-speaking\",\n                       \"added_by\": {\n                           \"id\": 8,\n                           \"name\": \"teacher tom\"\n                       }\n                   }\n               ]\n           },\n           {\n               \"id\": 3,\n               \"date\": \"2020-05-15\",\n               \"status\": 0,\n               \"materials\": [\n                   {\n                       \"id\": 4,\n                       \"title\": \"English Grammar\",\n                       \"instruction\": \"read the textbook\",\n                       \"description\": \"learn english grammar\",\n                       \"uploaded_file\": null,\n                       \"resource_link\": \"https://sample-lesson-link.com/english-grammar\",\n                       \"added_by\": {\n                           \"id\": 8,\n                           \"name\": \"teacher tom\"\n                       }\n                   }\n               ]\n           }\n       ],\n       \"students\": [\n           {\n               \"id\": 1,\n               \"name\": \"jayson\",\n               \"user_type\": \"s\"\n           },\n           {\n               \"id\": 2,\n               \"name\": \"grace\",\n               \"user_type\": \"s\"\n           },\n           {\n               \"id\": 3,\n               \"name\": \"jen\",\n               \"user_type\": \"s\"\n           },\n           {\n               \"id\": 4,\n               \"name\": \"davy\",\n               \"user_type\": \"s\"\n           }\n       ]\n    },\n    .\n    .\n    .\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "user_id",
          "content": "HTTP/1.1 422 user_id is not passed\n{\n    \"message\": \"The given data was invalid.\",\n    \"errors\": {\n        \"user_id\": [\n            \"The user id field is required.\"\n        ]\n    }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Api/ClassController.php",
    "groupTitle": "Classes",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>A JWT Token, e.g. &quot;Bearer {token}&quot;</p>"
          }
        ]
      }
    }
  }
] });
