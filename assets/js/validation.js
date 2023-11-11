document.addEventListener('DOMContentLoaded', function(e) {
  const formAuthentication = document.getElementById('formAuthentication'),
    formValidationSelect2Ele = jQuery(formAuthentication.querySelector('[name="formValidationSelect2"]')),
    formValidationTechEle = jQuery(formAuthentication.querySelector('[name="formValidationTech"]')),
    formValidationLangEle = formAuthentication.querySelector('[name="formValidationLang"]'),
    formValidationHobbiesEle = jQuery(formAuthentication.querySelector('.selectpicker')),
    tech = [
      'ReactJS',
      'Angular',
      'VueJS',
      'Html',
      'Css',
      'Sass',
      'Pug',
      'Gulp',
      'Php',
      'Laravel',
      'Python',
      'Bootstrap',
      'Material Design',
      'NodeJS'
    ];

  const fv = FormValidation.formValidation(formAuthentication, {
    fields: {
      formValidationName: {
        validators: {
          notEmpty: {
            message: 'Please enter your name'
          },
          stringLength: {
            min: 6,
            max: 30,
            message: 'The name must be more than 6 and less than 30 characters long'
          },
          regexp: {
            regexp: /^[a-zA-Z0-9 ]+$/,
            message: 'The name can only consist of alphabetical, number and space'
          }
        }
      },
      email: {
        validators: {
          notEmpty: {
            message: 'Please enter your email'
          },
          emailAddress: {
            message: 'The value is not a valid email address'
          }
        }
      },
      password: {
        validators: {
          notEmpty: {
            message: 'Please enter your password'
          }
        }
      },
      formValidationConfirmPass: {
        validators: {
          notEmpty: {
            message: 'Please confirm password'
          },
          identical: {
            compare: function() {
              return formAuthentication.querySelector('[name="formValidationPass"]').value;
            },
            message: 'The password and its confirm are not the same'
          }
        }
      },
      formValidationFile: {
        validators: {
          notEmpty: {
            message: 'Please select the file'
          }
        }
      },
      formValidationDob: {
        validators: {
          notEmpty: {
            message: 'Please select your DOB'
          },
          date: {
            format: 'YYYY/MM/DD',
            message: 'The value is not a valid date'
          }
        }
      },
      formValidationSelect2: {
        validators: {
          notEmpty: {
            message: 'Please select your country'
          }
        }
      },
      formValidationLang: {
        validators: {
          notEmpty: {
            message: 'Please select your language'
          }
        }
      },
      formValidationTech: {
        validators: {
          notEmpty: {
            message: 'Please select technology'
          }
        }
      },
      formValidationHobbies: {
        validators: {
          notEmpty: {
            message: 'Please select your hobbies'
          }
        }
      },
      formValidationBio: {
        validators: {
          notEmpty: {
            message: 'Please enter your bio'
          },
          stringLength: {
            min: 100,
            max: 500,
            message: 'The bio must be more than 100 and less than 500 characters long'
          }
        }
      },
      formValidationGender: {
        validators: {
          notEmpty: {
            message: 'Please select your gender'
          }
        }
      },
      formValidationPlan: {
        validators: {
          notEmpty: {
            message: 'Please select your preferred plan'
          }
        }
      },
      formValidationSwitch: {
        validators: {
          notEmpty: {
            message: 'Please select your preference'
          }
        }
      },
      formValidationCheckbox: {
        validators: {
          notEmpty: {
            message: 'Please confirm our T&C'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        // eleInvalidClass: '',
        eleValidClass: '',
        rowSelector: function(field, ele) {
          // field is the field name & ele is the field element
          switch (field) {
            case 'formValidationName':
            case 'formValidationEmail':
            case 'formValidationPass':
            case 'formValidationConfirmPass':
            case 'formValidationFile':
            case 'formValidationDob':
            case 'formValidationSelect2':
            case 'formValidationLang':
            case 'formValidationTech':
            case 'formValidationHobbies':
            case 'formValidationBio':
            case 'formValidationGender':
              return '.col-md-6';
            case 'formValidationPlan':
              return '.col-xl-3';
            case 'formValidationSwitch':
            case 'formValidationCheckbox':
              return '.col-12';
            default:
              return '.row';
          }
        }
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      // Submit the form when all fields are valid
      defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    },
    init: instance => {
      instance.on('plugins.message.placed', function(e) {
        //* Move the error message out of the `input-group` element
        if (e.element.parentElement.classList.contains('input-group')) {
          // `e.field`: The field name
          // `e.messageElement`: The message element
          // `e.element`: The field element
          e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        }
        //* Move the error message out of the `row` element for custom-options
        if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
          e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
        }
      });
    }
  });

  //? Revalidation third-party libs inputs on change trigger

  // Flatpickr
  flatpickr(formValidationExamples.querySelector('[name="formValidationDob"]'), {
    enableTime: false,
    // See https://flatpickr.js.org/formatting/
    dateFormat: 'Y/m/d',
    // After selecting a date, we need to revalidate the field
    onChange: function() {
      fv.revalidateField('formValidationDob');
    }
  });

  // Select2 (Country)
  if (formValidationSelect2Ele.length) {
    formValidationSelect2Ele.wrap('');
    formValidationSelect2Ele
      .select2({
        placeholder: 'Select country',
        dropdownParent: formValidationSelect2Ele.parent()
      })
      .on('change.select2', function() {
        // Revalidate the color field when an option is chosen
        fv.revalidateField('formValidationSelect2');
      });
  }

  // Typeahead

  // String Matcher function for typeahead
  const substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substrRegex;
      matches = [];
      substrRegex = new RegExp(q, 'i');
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });

      cb(matches);
    };
  };

  // Check if rtl
  if (isRtl) {
    $('.typeahead').attr('dir', 'rtl');
  }
  formValidationTechEle.typeahead(
    {
      hint: !isRtl,
      highlight: true,
      minLength: 1
    },
    {
      name: 'tech',
      source: substringMatcher(tech)
    }
  );

  // Tagify
  let formValidationLangTagify = new Tagify(formValidationLangEle);
  formValidationLangEle.addEventListener('change', onChange);
  function onChange() {
    fv.revalidateField('formValidationLang');
  }

  //Bootstrap select
  formValidationHobbiesEle.on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
    fv.revalidateField('formValidationHobbies');
  });
});
})();
                  