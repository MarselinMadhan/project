import javax.swing.*;
import javax.swing.border.TitledBorder;
import javax.swing.table.DefaultTableCellRenderer;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.io.FileWriter;
import java.text.NumberFormat;

public class frame extends JFrame {
    // Panel
    private JPanel ptitle;
    private JPanel pcenter;
    private JPanel psummary;
    private JPanel inputpanel;
    private JPanel tablepanel;
    // Lables
    private JLabel nameloan;
    private JLabel nameinterest;
    private JLabel namemonth;
    private JLabel emivalue;
    private JLabel payvalue;
    private JLabel intvalue;
    // Inputs
    private JFormattedTextField loanfield;
    private JTextField interestfield;
    private JTextField monthfield;
    // private JTextField bikeprice;
    // private JTextField downpayment;
    // Button
    private JButton calculate;
    private JButton reset;
    private JButton export;
    // Table
    private JTable table;
    private DefaultTableModel model;
    //
    private GridBagConstraints gbc;

    private Loan obj;
    private validate num;

    private void mainframe() {
        setSize(1000, 700);
        setTitle("EMI APP");
        setLayout(new BorderLayout(15, 15));
        setDefaultCloseOperation(EXIT_ON_CLOSE);
        setBackground(theme.bg);

    }

    private void components() {
        loanfield = new JFormattedTextField(NumberFormat.getNumberInstance());
        interestfield = new JTextField(20);
        monthfield = new JTextField(20);

        calculate = new JButton("Calculate");
        reset = new JButton("Reset");
        export = new JButton("💾 Export");

        payvalue = new JLabel("₹0.00");
        intvalue = new JLabel("₹0.00");
        emivalue = new JLabel("₹0.00");

        ptitle = new JPanel();
        pcenter = new JPanel();
        inputpanel = new JPanel();
        tablepanel = new JPanel();
        psummary = new JPanel();

        gbc = new GridBagConstraints();
        num = new validate();

    }

    private void titlepanel() {
        JLabel title = new JLabel("EMI CALCULATOR");
        title.setHorizontalAlignment(SwingConstants.CENTER);
        title.setFont(new Font("Segoe UI", Font.BOLD, 24));
        ptitle.add(title);
    }

    private void centerpanel() {

        pcenter.setLayout(new BorderLayout());

    }

    private void inputpanel() {

        TitledBorder inputpt = BorderFactory.createTitledBorder("Loan Details");
        inputpt.setTitleFont(theme.ptitle);
        inputpanel.setBackground(theme.white);

        inputpanel.setBorder(BorderFactory.createCompoundBorder(inputpt,
                BorderFactory.createEmptyBorder(0, 10, 0, 10)));
        inputpanel.setLayout(new GridBagLayout());

        nameloan = new JLabel("Loan Amount : ");
        nameloan.setFont(theme.label);
        loanfield.setFont(theme.label);
        loanfield.setColumns(20);

        nameinterest = new JLabel("Interest(%) : ");
        nameinterest.setFont(theme.label);
        interestfield.setFont(theme.label);

        namemonth = new JLabel("Period of Month : ");
        namemonth.setFont(theme.label);
        monthfield.setFont(theme.label);

        calculate.setFont(theme.button);
        calculate.setBackground(theme.primary);
        calculate.setForeground(theme.white);

        reset.setFont(theme.button);
        reset.setBackground(theme.primary);
        reset.setForeground(theme.white);

        gbc.gridx = 0;
        gbc.gridy = 0;
        gbc.insets = new Insets(10, 10, 10, 10);
        gbc.anchor = GridBagConstraints.WEST;
        inputpanel.add(nameloan, gbc);
        gbc.gridx = 0;
        gbc.gridy = 1;
        gbc.fill = GridBagConstraints.HORIZONTAL;
        inputpanel.add(loanfield, gbc);

        gbc.gridx = 0;
        gbc.gridy = 2;
        inputpanel.add(nameinterest, gbc);
        gbc.gridx = 0;
        gbc.gridy = 3;
        inputpanel.add(interestfield, gbc);

        gbc.gridx = 0;
        gbc.gridy = 4;
        inputpanel.add(namemonth, gbc);
        gbc.gridx = 0;
        gbc.gridy = 5;
        inputpanel.add(monthfield, gbc);

        gbc.gridx = 0;
        gbc.gridy = 6;
        gbc.anchor = GridBagConstraints.WEST;
        gbc.fill = GridBagConstraints.NONE;
        inputpanel.add(calculate, gbc);

        gbc.gridx = 0;
        gbc.gridy = 6;
        gbc.anchor = GridBagConstraints.CENTER;
        // gbc.insets = new Insets(0,20,0,0);
        inputpanel.add(reset, gbc);

    }

    private void tablepanel() {

        tablepanel.setBackground(theme.white);
        TitledBorder tablept = BorderFactory.createTitledBorder("Payment Schedule");
        tablept.setTitleFont(theme.ptitle);
        tablepanel.setLayout(new BorderLayout());
        tablepanel.setBorder(BorderFactory.createCompoundBorder(tablept,
                BorderFactory.createEmptyBorder(10, 10, 10, 10)));

        String[] column = { "Month", "Interest", "PrincipalPaid", "loan" };
        model = new DefaultTableModel(column, 0) {
            @Override
            public boolean isCellEditable(int row, int column) {
                return false;
            }
        };
        table = new JTable(model);
        JScrollPane scroll = new JScrollPane(table);
        tablepanel.add(scroll);
        DefaultTableCellRenderer tablecenter = new DefaultTableCellRenderer();
        tablecenter.setHorizontalAlignment(JLabel.CENTER);
        for (int i = 0; i < table.getColumnCount(); i++) {
            table.getColumnModel().getColumn(i).setCellRenderer(tablecenter);
        }

        // table design

        table.setRowHeight(30);
        table.setFont(new Font("Segoe UI", Font.PLAIN, 15));
        table.getTableHeader().setFont(new Font("Segoe UI", Font.BOLD, 17));
        table.getTableHeader().setBackground(theme.primary);
        table.getTableHeader().setForeground(theme.white);
        table.getTableHeader().setPreferredSize(new Dimension(0, 35));
        table.getTableHeader().setReorderingAllowed(false);
        pcenter.add(tablepanel, BorderLayout.CENTER);

    }

    private void summarypanel() {

        psummary.setBackground(theme.white);
        TitledBorder summarypt = BorderFactory.createTitledBorder("EMI Summary");
        summarypt.setTitleFont(theme.ptitle);
        psummary.setLayout(new GridBagLayout());
        psummary.setBorder(BorderFactory.createCompoundBorder(summarypt,
                BorderFactory.createEmptyBorder(10, 10, 10, 10)));
        JLabel monemi = new JLabel("Monthy EMI    : ");
        emivalue.setFont(theme.summary);
        monemi.setFont(theme.label);

        JLabel totint = new JLabel("Total Interest   : ");
        intvalue.setFont(theme.summary);
        totint.setFont(theme.label);

        JLabel totpay = new JLabel("Total Payment : ");
        payvalue.setFont(theme.summary);
        totpay.setFont(theme.label);

        gbc.anchor = GridBagConstraints.WEST;

        gbc.insets = new Insets(5, 5, 5, 5);
        gbc.gridx = 0;
        gbc.gridy = 0;
        psummary.add(monemi, gbc);

        gbc.gridx = 1;
        gbc.gridy = 0;
        gbc.weightx = 1;
        psummary.add(emivalue, gbc);

        gbc.gridx = 0;
        gbc.gridy = 1;
        gbc.weightx = 0;
        psummary.add(totint, gbc);

        gbc.gridx = 1;
        gbc.gridy = 1;
        gbc.weightx = 1;
        psummary.add(intvalue, gbc);

        gbc.gridx = 0;
        gbc.gridy = 2;
        gbc.weightx = 0;
        psummary.add(totpay, gbc);

        gbc.gridx = 1;
        gbc.gridy = 2;
        gbc.weightx = 1;
        psummary.add(payvalue, gbc);

        gbc.gridx= 0;
        gbc.gridy= 2;
        gbc.gridwidth = 2;
        gbc.anchor = GridBagConstraints.EAST;
        psummary.add(export,gbc);
        export.setVisible(false);
        export.setFont(theme.button);
        export.setBackground(new Color(46, 139, 87));
        export.setForeground(theme.white);

    }

    private void addpanels() {

        add(ptitle, BorderLayout.NORTH);

        pcenter.add(inputpanel, BorderLayout.WEST);
        pcenter.add(tablepanel, BorderLayout.CENTER);
        add(pcenter, BorderLayout.CENTER);

        add(psummary, BorderLayout.SOUTH);

    }

    private void action() {
        calculate.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                try {
                    if (num.isvalidate(loanfield, interestfield, monthfield)) {
                        return;
                    }
                    calculateemi();

                } catch (Exception ex) {
                    JOptionPane.showMessageDialog(null, "action failed");
                }
            }
        });

        reset.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                try {
                    reset();
                } catch (Exception ex) {
                    JOptionPane.showMessageDialog(null, ex);
                }
            }
        });

        export.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e){
                try {
                    export();
                } catch (Exception ex) {
                    JOptionPane.showMessageDialog(null, ex);
                }


            } 
        });
    }

    private void calculateemi() {

        try {

            double amount = Double.parseDouble(loanfield.getText().replace(",", ""));
            double interest = Double.parseDouble(interestfield.getText());
            int month = Integer.parseInt(monthfield.getText());
            obj = new Loan(amount, interest, month);
            obj.Calculate(model);
            updatesummary();
            export.setVisible(true);

        } catch (Exception e) {
            JOptionPane.showMessageDialog(this, "Enter the valid Input",
                    "Error Message", JOptionPane.WARNING_MESSAGE);
        }

    }

    private void reset(){
        loanfield.setText("");
        interestfield.setText("");
        monthfield.setText("");

        emivalue.setText("₹0.00");
        intvalue.setText("₹0.00");
        payvalue.setText("₹0.00");

        model.setRowCount(0);

        loanfield.requestFocus();
        
        export.setVisible(false);
    }

    private void export(){

        try {

        JFileChooser chooser = new JFileChooser();
        int result = chooser.showSaveDialog(this);
        
        if (result == JFileChooser.APPROVE_OPTION) {

            Object[] option = {"save","don't save","cancel"}; 
            //JOptionPane.showMessageDialog(null, "File saved successfully");
            JOptionPane.showOptionDialog(null,"save file ?" , "confirm", 
            JOptionPane.YES_NO_CANCEL_OPTION, JOptionPane.QUESTION_MESSAGE, null,option ,option[0] );
            
            File file = chooser.getSelectedFile();
            FileWriter writer = new FileWriter(file);
            writer.write("EMI summary\n");
            writer.write("Monthly EMI : "+emivalue.getText() +"\n");
            writer.write("Total Interest : "+intvalue.getText() +"\n");
            writer.write("Total Payment : "+payvalue.getText() +"\n");
            writer.write("Month    Interest      principle         Balance \n" );
            for(int row = 0; row < table.getRowCount();row++){
                for(int col=0;col < table.getColumnCount(); col++){
                    writer.write(table.getValueAt(row,col).toString()+"       ");
                }
                 writer.write("\n");
            }
           
            writer.close();
            
            
            
        }
        

        } catch (Exception ex) {

            JOptionPane.showMessageDialog(null, "Error in export");
           
        }

        
    }

    private void updatesummary() {
        emivalue.setText(String.format("₹%,.2f", obj.getemi()));
        intvalue.setText(String.format("₹%,.2f", obj.gettotal_interest()));
        payvalue.setText(String.format("₹%,.2f", obj.gettotal_payment()));
    }

    frame() {

        mainframe();

        components();

        titlepanel();

        centerpanel();
        
        inputpanel();

        action();

        tablepanel();

        summarypanel();

        addpanels();

        setVisible(true);
        
    }

}
