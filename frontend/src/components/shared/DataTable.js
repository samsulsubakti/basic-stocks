import React, { forwardRef, useMemo, useRef, useEffect } from "react";
import PropTypes from "prop-types";
import { Table, Pagination, Select, Checkbox } from "components/ui";
import TableRowSkeleton from "./loaders/TableRowSkeleton";
import Loading from "./Loading";
import { useTable, usePagination, useSortBy, useRowSelect } from "react-table";

const { Tr, Th, Td, THead, TBody, Sorter } = Table;

const IndeterminateCheckbox = forwardRef((props, ref) => {
  const {
    indeterminate,
    onChange,
    onCheckBoxChange,
    onIndeterminateCheckBoxChange,
    ...rest
  } = props;

  const defaultRef = useRef();
  const resolvedRef = ref || defaultRef;

  useEffect(() => {
    resolvedRef.current.indeterminate = indeterminate;
  }, [resolvedRef, indeterminate]);

  const handleChange = (e) => {
    onChange(e);
    onCheckBoxChange?.(e);
    onIndeterminateCheckBoxChange?.(e);
  };

  return (
    <Checkbox
      className="mb-0"
      ref={resolvedRef}
      onChange={(_, e) => handleChange(e)}
      {...rest}
    />
  );
});

const DataTable = (props) => {
  const {
    skeletonAvatarColumns,
    columns,
    data,
    loading,
    onCheckBoxChange,
    onIndeterminateCheckBoxChange,
    onPaginationChange,
    onSelectChange,
    onSort,
    pageSizes,
    selectable,
    skeletonAvatarProps,
    pagingData,
    autoResetSelectedRows,
    wrapClass,
    showPagination,
    showLimitPerPage,
  } = props;

  const { pageSize, pageIndex, total } = pagingData;

  const pageSizeOption = useMemo(
    () =>
      pageSizes.map((number) => ({ value: number, label: `${number} / page` })),
    [pageSizes]
  );

  const handleCheckBoxChange = (checked, row, is_loading) => {
    if (!is_loading) {
      onCheckBoxChange?.(checked, row);
    }
  };

  const handleIndeterminateCheckBoxChange = (checked, rows, is_loading) => {
    if (!is_loading) {
      onIndeterminateCheckBoxChange?.(checked, rows);
    }
  };

  const { getTableProps, getTableBodyProps, headerGroups, prepareRow, page } =
    useTable(
      {
        columns,
        data,
        manualPagination: true,
        manualSortBy: true,
        autoResetSelectedRows,
        is_loading: loading,
      },
      useSortBy,
      usePagination,
      useRowSelect,
      (hooks) => {
        if (selectable) {
          hooks.visibleColumns.push((columns) => [
            {
              id: "selection",
              width: 80,
              Header: (props) => {
                return (
                  <div>
                    <IndeterminateCheckbox
                      {...props.getToggleAllRowsSelectedProps()}
                      onIndeterminateCheckBoxChange={(e) =>
                        handleIndeterminateCheckBoxChange(
                          e.target.checked,
                          props.rows,
                          props.is_loading
                        )
                      }
                    />
                  </div>
                );
              },
              Cell: ({ row, is_loading }) => (
                <div>
                  <IndeterminateCheckbox
                    {...row.getToggleRowSelectedProps()}
                    onCheckBoxChange={(e) =>
                      handleCheckBoxChange(
                        e.target.checked,
                        row.original,
                        is_loading
                      )
                    }
                  />
                </div>
              ),
              sortable: false,
            },
            ...columns,
          ]);
        }
      }
    );

  const handlePaginationChange = (page) => {
    if (!loading) {
      onPaginationChange?.(page);
    }
  };

  const handleSelectChange = (value) => {
    if (!loading) {
      onSelectChange?.(Number(value));
    }
  };

  const handleSort = (column) => {
    if (!loading) {
      const { id, isSortedDesc, toggleSortBy, clearSortBy } = column;
      const sortOrder = isSortedDesc ? "desc" : "asc";
      toggleSortBy(!isSortedDesc);
      onSort?.({ order: sortOrder, key: id }, { id, clearSortBy });
    }
  };

  return (
    <Loading loading={loading && data.length !== 0} type="cover">
      <Table
        {...getTableProps({
          wrapClass: wrapClass,
        })}
      >
        <THead>
          {headerGroups.map((headerGroup) => (
            <Tr {...headerGroup.getHeaderGroupProps()}>
              {headerGroup.headers.map((column) => (
                <Th
                  {...column.getHeaderProps({
                    style: { minWidth: column.minWidth, width: column.width },
                  })}
                >
                  {column.render("Header") &&
                    (column.sortable ? (
                      <div
                        className="cursor-pointer"
                        onClick={() => handleSort(column)}
                      >
                        {column.render("Header")}
                        <span>
                          <Sorter sort={column.isSortedDesc} />
                        </span>
                      </div>
                    ) : (
                      <div>{column.render("Header")}</div>
                    ))}
                </Th>
              ))}
            </Tr>
          ))}
        </THead>
        {loading && data.length === 0 ? (
          <TableRowSkeleton
            columns={columns.length}
            rows={pagingData.pageSize}
            avatarInColumns={skeletonAvatarColumns}
            avatarProps={skeletonAvatarProps}
          />
        ) : (
          <TBody {...getTableBodyProps()}>
            {page.length === 0 ? (
              <Tr>
                <Td colSpan={100}>No Data</Td>
              </Tr>
            ) : (
              page.map((row, i) => {
                prepareRow(row);
                return (
                  <Tr {...row.getRowProps()}>
                    {row.cells.map((cell) => {
                      return (
                        <Td {...cell.getCellProps()}>{cell.render("Cell")}</Td>
                      );
                    })}
                  </Tr>
                );
              })
            )}
          </TBody>
        )}
      </Table>

      <div className="flex items-center justify-between mt-4">
        {showPagination && (
          <Pagination
            pageSize={pageSize}
            currentPage={pageIndex}
            total={total}
            onChange={handlePaginationChange}
          />
        )}

        {showLimitPerPage && (
          <div style={{ minWidth: 130 }}>
            <Select
              size="sm"
              menuPlacement="top"
              isSearchable={false}
              value={pageSizeOption.filter(
                (option) => option.value === pageSize
              )}
              options={pageSizeOption}
              onChange={(option) => handleSelectChange(option.value)}
            />
          </div>
        )}
      </div>
    </Loading>
  );
};

DataTable.propTypes = {
  columns: PropTypes.array,
  data: PropTypes.array,
  loading: PropTypes.bool,
  onCheckBoxChange: PropTypes.func,
  onIndeterminateCheckBoxChange: PropTypes.func,
  onPaginationChange: PropTypes.func,
  onSelectChange: PropTypes.func,
  onSort: PropTypes.func,
  pageSizes: PropTypes.arrayOf(PropTypes.number),
  selectable: PropTypes.bool,
  skeletonAvatarColumns: PropTypes.arrayOf(PropTypes.number),
  skeletonAvatarProps: PropTypes.object,
  pagingData: PropTypes.shape({
    total: PropTypes.number,
    pageIndex: PropTypes.number,
    pageSize: PropTypes.number,
  }),
  autoResetSelectedRows: PropTypes.bool,
  wrapClass: PropTypes.string,
  showPagination: PropTypes.bool,
  showLimitPerPage: PropTypes.bool,
};

DataTable.defaultProps = {
  pageSizes: [10, 25, 50, 100, 300, 500, 1000],
  pagingData: {
    total: 0,
    pageIndex: 1,
    pageSize: 10,
  },
  data: [],
  columns: [],
  selectable: false,
  loading: false,
  autoResetSelectedRows: true,
  wrapClass: "",
  showPagination: true,
  showLimitPerPage: true,
};

export default DataTable;
