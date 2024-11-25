import { Button, Dialog, Notification, toast } from "components/ui";
import { Link } from "react-router-dom";
import { CSVLink } from "react-csv";
import { TableSearch } from "./search";
import { useMemo, useState } from "react";
import { FormData } from "./form";
import { PageConfig } from "./config";
import { ConfirmDialog } from "components/shared";
import { apiDestroy } from "./api";
import {
  SymbolIcon,
  MixerHorizontalIcon,
  DownloadIcon,
  Component2Icon,
  PlusIcon,
  TrashIcon,
} from "@radix-ui/react-icons";

export const Tools = (props) => {
  const [dialogAddOpen, setDialogAddOpen] = useState(false);
  const [openDialogBulkDelete, setOpenDialogBulkDelete] = useState(false);

  const csvHeader = useMemo(() => {
    let h = [];
    for (let index = 0; index < props.checkboxList.length; index++) {
      const el = props.checkboxList[index];
      h.push({
        label: el,
        key: el,
      });
    }
    return h;
  }, [props.checkboxList]);

  return (
    <>
      <div className="flex flex-col lg:flex-row lg:items-center">
        {PageConfig.enableBulkDelete && props.deleteIds.length > 0 && (
          <Button
            variant="solid"
            color="red-600"
            size="sm"
            className="block md:inline-block lg:mr-2  lg:mb-0 mb-4"
            icon={<TrashIcon />}
            onClick={() => {
              setOpenDialogBulkDelete(true);
            }}
          >
            Bulk Delete
          </Button>
        )}

        {PageConfig.enableSearchTools && (
          <TableSearch localState={props.localState} getData={props.getData} />
        )}

        {PageConfig.enableRefreshTable && (
          <Button
            icon={<SymbolIcon />}
            size="sm"
            className="block   rtl:md:mr-2 lg:mb-0 mb-4"
            onClick={() => {
              props.getData(props.localState.params);
            }}
          />
        )}

        {PageConfig.enableColumnTools && (
          <Button
            size="sm"
            className="block md:inline-block ltr:lg:ml-2 rtl:md:mr-2 lg:mb-0 mb-4"
            icon={<Component2Icon />}
            onClick={props.openColumns}
          >
            Columns
          </Button>
        )}

        {PageConfig.enableFilterTools && (
          <Button
            size="sm"
            className="block md:inline-block ltr:lg:ml-2 rtl:md:mr-2 lg:mb-0 mb-4"
            icon={<MixerHorizontalIcon />}
            onClick={props.openFilter}
          >
            Filter
          </Button>
        )}

        {PageConfig.enableExportTools && (
          <CSVLink
            className="block lg:inline-block lg:mx-2 lg:mb-0 mb-4"
            filename={"file.csv"}
            target="_blank"
            data={props.localState.data}
            headers={csvHeader}
          >
            <Button block size="sm" icon={<DownloadIcon />}>
              Export
            </Button>
          </CSVLink>
        )}

        {PageConfig.enableCreate && (
          <Link className="block lg:inline-block lg:mb-0 mb-4">
            <Button
              block
              variant="solid"
              size="sm"
              icon={<PlusIcon />}
              onClick={() => {
                setDialogAddOpen(true);
              }}
            >
              Add
            </Button>
          </Link>
        )}
      </div>

      <ConfirmDialog
        isOpen={openDialogBulkDelete}
        onClose={() => {
          setOpenDialogBulkDelete(false);
        }}
        onRequestClose={() => {
          setOpenDialogBulkDelete(false);
        }}
        type="danger"
        title="Bulk Delete data"
        onCancel={() => {
          setOpenDialogBulkDelete(false);
        }}
        onConfirm={async () => {
          try {
            let params = {
              ids: [],
            };

            for (let index = 0; index < props.deleteIds.length; index++) {
              const el = props.deleteIds[index];
              params.ids.push(el);
            }

            await apiDestroy(0, params);
            props.getData({ ...props.localState.params, page: 1 });
            setOpenDialogBulkDelete(false);

            toast.push(
              <Notification
                title={"Successfuly Deleted"}
                type="success"
                duration={2500}
              >
                Data successfuly deleted
              </Notification>,
              {
                placement: "top-center",
              }
            );

            props.setIds([]);
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
        }}
        confirmButtonColor="red-600"
      >
        <p>
          Are you sure you want to delete this data? All record related to this
          data will be deleted as well. This action cannot be undone.
        </p>
      </ConfirmDialog>

      <Dialog
        isOpen={dialogAddOpen}
        onClose={() => {
          setDialogAddOpen(false);
        }}
        onRequestClose={() => {
          setDialogAddOpen(false);
        }}
        width={700}
        bodyOpenClassName="dialog-scroll"
      >
        <div className="flex flex-col h-full justify-between">
          <FormData
            onDialogClose={() => {
              setDialogAddOpen(false);
            }}
            getData={props.getData}
            localState={props.localState}
            title="New Data"
          />
        </div>
      </Dialog>
    </>
  );
};
