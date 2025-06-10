from xlrd import open_workbook
# from macpath import split
#[.nrows] = number of row,
# [.ncols] = number of column

#[.sheet_by_name()] = find sheet with name, 
# [.sheet_by_index()] = find sheet with number

#[.cell()]=find cell example cell(0,0[rowx,colx]) = text:'A1'\cell() output type\, 
# [.cell_value()]= find cell example cell_value(0,0[rowx,colx]) = A1\cell_value output without type\

#Without (required positional argument)
#[.row()] AND [.col()] = output whole row, output whole column with type
# [.row_values()] AND [.col_values()] = output whole row, output whole column without type
wb = open_workbook("EXAMPLE_DT.xls")
sheet = wb.sheet_by_name("Model Info")

output = []
count = 0
for column in range(sheet.nrows):
    row_value = sheet.row_values(column)
    if "Y" in row_value[4]:
        avalue=row_value[1].split(',')
        c_sp=count(avalue)
        if c_sp>=1:
            for x in range(c_sp):
                
                count += 1
                output.append()
        # join_it = "".join(map(str,output))
        print(output)
# with open("fuck.dpi","r+") as r:
    