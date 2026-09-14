
import javax.swing.*;

public class validate {

    double loannum ;
    double interestnum;
    int monthnum;

    public  boolean isvalidate(JFormattedTextField loanfield, JTextField interestfield, JTextField monthfield) {

        this.loannum = Double.parseDouble(loanfield.getText().replace(",","" ));
        this.interestnum = Double.parseDouble(interestfield.getText());
        this.monthnum = Integer.parseInt(monthfield.getText());
        if (loanfield.getText().trim().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Please Enter the loan Amount",
                    "Input Error", JOptionPane.WARNING_MESSAGE);

            loanfield.requestFocus();

            return true;

        }
        if (loannum <= 0) {
            JOptionPane.showMessageDialog(null, "Please Enter the Valid loan Amount",
                    "Input Error", JOptionPane.WARNING_MESSAGE);

            loanfield.requestFocus();

            return true;
        }

        if (interestfield.getText().trim().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Please Enter the Interest %",
                    "Input Error", JOptionPane.WARNING_MESSAGE);

            interestfield.requestFocus();

            return true;

        }
        if (interestnum <= 0) {
            JOptionPane.showMessageDialog(null, "Please Enter the Valid Interest %",
                    "Input Error", JOptionPane.WARNING_MESSAGE);

            interestfield.requestFocus();

            return true;

        }
        if (monthfield.getText().trim().isEmpty()) {
            JOptionPane.showMessageDialog(null, "Please Enter the Month",
                    "Input Error", JOptionPane.WARNING_MESSAGE);
            monthfield.requestFocus();
            return true;

        }

        if (monthnum <= 0) {
            JOptionPane.showMessageDialog(null, "Please Enter the Valid Month",
                    "Input Error", JOptionPane.WARNING_MESSAGE);
            monthfield.requestFocus();

            return true;
        }
        return false;
    }
}
