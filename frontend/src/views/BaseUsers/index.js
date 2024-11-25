import { useCallback, useEffect, useRef, useState } from "react";
import { AdaptableCard } from "components/shared";
import { apiIndex } from "./api";
import { PageConfig } from "./config";
import { Tools } from "./tools";
import { PageTable } from "./table";
import { FormFilter } from "./form_filter";
import { Notification, toast } from "components/ui";
import { FormColumn } from "./form_column";

const Page = () => {
  const firstLoad = useRef(true);
  const firstReq = useRef(true);
  const [openFilter, setOpenFilter] = useState(false);
  const [openColumns, setOpenColumns] = useState(false);
  const [ids, setIds] = useState([]);
  const [checkboxList, setCheckboxList] = useState([]);
  const [localState, setLocalState] = useState({
    loading: false,
    data: [],
    meta: null,
    params: {
      q: "",
      type: "pagination",
      page: 1,
      limit: 10,
      order_by: "",
      sort_by: "",
      options: [],
      relations: [].join(),
    },
  });

  const getData = useCallback(
    async (params) => {
      try {
        setLocalState({
          ...localState,
          loading: true,
        });

        const ress = await apiIndex(params);

        if (firstReq.current) {
          await new Promise((resolve) => setTimeout(resolve, 1000));
          firstReq.current = false;
        }

        if (ress.data?.meta?.current_page !== localState.meta?.current_page) {
          setIds([]);
        }

        setLocalState({
          ...localState,
          loading: false,
          data: ress.data?.data || [],
          meta: ress.data?.meta || null,
          params: params,
        });
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
    },
    [localState]
  );

  useEffect(() => {
    if (firstLoad.current) {
      getData(localState.params);
      firstLoad.current = false;
    }
  }, [getData, localState]);

  useEffect(() => {
    let x = [];

    for (let index = 0; index < PageConfig.listFields.length; index++) {
      const el = PageConfig.listFields[index];
      if (el.is_show) {
        x.push(el.key);
      }
    }
    setCheckboxList(x);
  }, []);

  return (
    <AdaptableCard className="h-full" bodyClass="h-full">
      <div className="xl:flex items-center justify-between mb-4">
        <h3 className="mb-4 lg:mb-0">
          {PageConfig.moduleTitle} &raquo; {PageConfig.pageTitle}
        </h3>
        <Tools
          localState={localState}
          setLocalState={setLocalState}
          getData={getData}
          deleteIds={ids}
          setIds={setIds}
          openFilter={() => {
            setOpenFilter(!openFilter);
            setOpenColumns(false);
          }}
          openColumns={() => {
            setOpenColumns(!openColumns);
            setOpenFilter(false);
          }}
          checkboxList={checkboxList}
        />
      </div>
      {openFilter && (
        <div className="border border-slate-500 p-3 mb-5 rounded ">
          <FormFilter localState={localState} getData={getData} />
        </div>
      )}

      {openColumns && (
        <div className="border border-slate-500 p-3 mb-5 rounded ">
          <FormColumn
            checkboxList={checkboxList}
            setCheckboxList={setCheckboxList}
          />
        </div>
      )}

      <PageTable
        localState={localState}
        setLocalState={setLocalState}
        getData={getData}
        setIds={setIds}
        bulk_ids={ids}
        checkboxList={checkboxList}
      />
    </AdaptableCard>
  );
};

export default Page;
