import React from "react";
import {
  Input,
  Button,
  FormItem,
  FormContainer,
  toast,
  Notification,
  DatePicker,
} from "components/ui";
import { Field, Form, Formik } from "formik";

import { PageConfig } from "./config";
import dayjs from "dayjs";

export const FormFilter = ({ getData, localState }) => {
  const formInit = {};

  for (let index = 0; index < PageConfig.formFilterFields.length; index++) {
    const el = PageConfig.formFilterFields[index];
    formInit[el.key] = "";
  }

  return (
    <div>
      <h5 className="mb-4">Filter</h5>

      <Formik
        initialValues={formInit}
        onSubmit={async (values, { setSubmitting, setErrors }) => {
          setSubmitting(true);
          let options = [];

          for (const el in values) {
            if (values[el]) {
              let v = values[el];
              let key = PageConfig.formFilterFields.find((x) => x.key === el);

              if (key && key.type === "date") {
                v = dayjs(v).format("YYYY-MM-DD");
              }
              options.push("filter," + el + ",equal," + v);
            }
          }

          try {
            await getData({ ...localState.params, options: options, page: 1 });
          } catch (error) {
            toast.push(
              <Notification title={"Error"} type="danger">
                {error?.response?.data?.message ||
                  error?.message ||
                  "Something went wrong"}
              </Notification>,
              {
                placement: "top-center",
              }
            );
          }

          setSubmitting(false);
        }}
      >
        {({ values, touched, errors, isSubmitting, resetForm }) => {
          return (
            <Form>
              <FormContainer>
                <div className="lg:grid grid-cols-5 gap-4">
                  {PageConfig.formFilterFields.map((item) => {
                    let input = (
                      <Field
                        type="text"
                        name={item.key}
                        placeholder={item.label}
                        component={Input}
                      />
                    );

                    if (item.type === "date") {
                      input = (
                        <Field name={item.key}>
                          {({ field, form }) => {
                            return (
                              <DatePicker
                                field={field}
                                placeholder={item.label}
                                form={form}
                                value={values ? values[item.key] : ""}
                                onChange={(date) => {
                                  form.setFieldValue(field.name, date);
                                }}
                              />
                            );
                          }}
                        </Field>
                      );
                    }

                    return (
                      <div key={item.key}>
                        <FormItem
                          label={item.label}
                          invalid={
                            errors &&
                            touched &&
                            errors[item.key] &&
                            touched[item.key]
                          }
                          errorMessage={errors ? errors[item.key] : ""}
                        >
                          {input}
                        </FormItem>
                      </div>
                    );
                  })}
                </div>

                <div className="text-right mt-6">
                  <Button
                    className="mr-2"
                    variant="plain"
                    type="button"
                    onClick={() => {
                      resetForm();
                      getData({ ...localState.params, page: 1, options: [] });
                    }}
                  >
                    Reset
                  </Button>
                  <Button variant="solid" type="submit" loading={isSubmitting}>
                    {isSubmitting ? "Loading..." : "Submit"}
                  </Button>
                </div>
              </FormContainer>
            </Form>
          );
        }}
      </Formik>
    </div>
  );
};
