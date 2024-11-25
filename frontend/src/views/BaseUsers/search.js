import { Input } from "components/ui";
import { useRef } from "react";
import { HiOutlineSearch } from "react-icons/hi";
import { debounce } from "lodash";

export const TableSearch = (props) => {
  const searchInput = useRef();
  const debounceFn = debounce(handleDebounceFn, 500);

  function handleDebounceFn(val) {
    if (typeof val === "string" && val.length > 1) {
      props.getData({ ...props.localState.params, page: 1, q: val });
    }

    if (typeof val === "string" && val.length === 0) {
      props.getData({ ...props.localState.params, page: 1, q: val });
    }
  }

  const onEdit = (e) => {
    debounceFn(e.target.value);
  };

  return (
    <Input
      ref={searchInput}
      className=" lg:w-52 lg:mb-0 mb-4 mr-2"
      size="sm"
      placeholder="Search..."
      suffix={<HiOutlineSearch className="text-lg" />}
      onChange={onEdit}
    />
  );
};
